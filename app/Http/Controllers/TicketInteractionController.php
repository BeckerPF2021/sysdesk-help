<?php

namespace App\Http\Controllers;

use App\Models\TicketInteraction;
use App\Models\User;
use App\Models\Ticket;
use App\Models\InteractionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\TicketInteractionMail;

class TicketInteractionController extends Controller
{
    public function index(Ticket $ticket)
    {
        $interactions = TicketInteraction::with(['user', 'interactionType'])
            ->where('fk_ticket_id', $ticket->id)
            ->latest()
            ->paginate(10);

        return view('ticket_interactions.index', compact('interactions', 'ticket'));
    }

    public function create(Ticket $ticket)
    {
        $users = User::all();
        $interactionTypes = InteractionType::all();
        return view('ticket_interactions.create', compact('ticket', 'users', 'interactionTypes'));
    }

    public function store(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'text' => 'required|string',
            'comment_date' => 'required|date',
            'interaction_type' => 'required|exists:interaction_types,id',
            'file' => 'nullable|file|max:10240', // max 10MB
        ]);

        $validated['fk_ticket_id'] = $ticket->id;
        $validated['fk_user_id'] = auth()->id();

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('ticket_interactions', 'public');

            $validated['file_path'] = $path;
            $validated['file_type'] = $file->getClientMimeType();
            $validated['file_size'] = $file->getSize();
        }

        $interaction = TicketInteraction::create($validated);

        // Carregar relacionamentos necessários para enviar e-mail
        $interaction->load(['user', 'interactionType', 'ticket.responsibleUser', 'ticket.user']);

        // Preparar lista de e-mails sem duplicidade
        $emails = [];

        if ($ticket->responsibleUser && $ticket->responsibleUser->email) {
            $emails[] = $ticket->responsibleUser->email;
        }

        if ($ticket->user && $ticket->user->email && !in_array($ticket->user->email, $emails)) {
            $emails[] = $ticket->user->email;
        }

        // Enviar e-mails para cada destinatário
        foreach ($emails as $email) {
            Mail::to($email)->send(new TicketInteractionMail($interaction));
        }

        return redirect()->route('tickets.show', $ticket->id)
            ->with('success', 'Interação registrada com sucesso e e-mails enviados aos envolvidos.');
    }

    public function show(Ticket $ticket, TicketInteraction $ticketInteraction)
    {
        return view('ticket_interactions.show', compact('ticketInteraction', 'ticket'));
    }

    public function edit(Ticket $ticket, TicketInteraction $ticketInteraction)
    {
        $users = User::all();
        $interactionTypes = InteractionType::all();
        return view('ticket_interactions.edit', compact('ticketInteraction', 'users', 'interactionTypes', 'ticket'));
    }

    public function update(Request $request, Ticket $ticket, TicketInteraction $ticketInteraction)
    {
        $validated = $request->validate([
            'text' => 'required|string',
            'comment_date' => 'required|date',
            'interaction_type' => 'required|exists:interaction_types,id',
            'file' => 'nullable|file|max:10240', // max 10MB
        ]);

        if ($request->hasFile('file')) {
            // Apagar arquivo antigo se existir
            if ($ticketInteraction->file_path && Storage::disk('public')->exists($ticketInteraction->file_path)) {
                Storage::disk('public')->delete($ticketInteraction->file_path);
            }

            $file = $request->file('file');
            $path = $file->store('ticket_interactions', 'public');

            $validated['file_path'] = $path;
            $validated['file_type'] = $file->getClientMimeType();
            $validated['file_size'] = $file->getSize();
        }

        $ticketInteraction->update($validated);

        $ticketInteraction->load(['user', 'interactionType', 'ticket.responsibleUser', 'ticket.user']);

        // Preparar lista de e-mails sem duplicidade
        $emails = [];

        if ($ticket->responsibleUser && $ticket->responsibleUser->email) {
            $emails[] = $ticket->responsibleUser->email;
        }

        if ($ticket->user && $ticket->user->email && !in_array($ticket->user->email, $emails)) {
            $emails[] = $ticket->user->email;
        }

        // Enviar e-mails para cada destinatário
        foreach ($emails as $email) {
            Mail::to($email)->send(new TicketInteractionMail($ticketInteraction));
        }

        return redirect()->route('ticket_interactions.index', $ticket->id)
            ->with('success', 'Interação atualizada com sucesso e e-mails enviados aos envolvidos.');
    }

    public function destroy(Ticket $ticket, TicketInteraction $ticketInteraction)
    {
        if ($ticketInteraction->file_path && Storage::disk('public')->exists($ticketInteraction->file_path)) {
            Storage::disk('public')->delete($ticketInteraction->file_path);
        }

        $ticketInteraction->delete();

        return redirect()->route('ticket_interactions.index', $ticket->id)
            ->with('success', 'Interação removida com sucesso.');
    }

    public function downloadFile(Ticket $ticket, TicketInteraction $ticketInteraction)
    {
        if (!$ticketInteraction->file_path || !Storage::disk('public')->exists($ticketInteraction->file_path)) {
            abort(404, 'Arquivo não encontrado.');
        }

        return Storage::disk('public')->download($ticketInteraction->file_path);
    }
}