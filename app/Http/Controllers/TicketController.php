<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use App\Models\Category;
use App\Models\TicketPriority;
use App\Models\TicketStatus;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketCreatedMail;
use App\Mail\TicketUpdatedMail;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with([
            'user',
            'responsibleUser',
            'category',
            'ticketPriority',
            'ticketStatus',
            'department'
        ])->get();

        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('tickets.create', [
            'users' => User::all(),
            'categories' => Category::all(),
            'ticketPriorities' => TicketPriority::all(),
            'ticketStatuses' => TicketStatus::all(),
            'departments' => Department::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'fk_user_id' => 'required|exists:users,id',
            'fk_responsible_user_id' => 'nullable|exists:users,id',
            'fk_category_id' => 'required|exists:categories,id',
            'fk_ticket_status_id' => 'required|exists:ticket_statuses,id',
            'fk_department_id' => 'required|exists:departments,id',
            'fk_ticket_priority_id' => 'required|exists:ticket_priorities,id',
        ]);

        $ticket = Ticket::create($validated);

        // Enviar e-mail para o responsável (caso definido)
        if ($ticket->fk_responsible_user_id) {
            $responsibleUser = User::find($ticket->fk_responsible_user_id);
            if ($responsibleUser && $responsibleUser->email) {
                Mail::to($responsibleUser->email)->send(new TicketCreatedMail($ticket));
            }
        }

        return redirect()->route('tickets.index')->with('success', 'Ticket criado com sucesso e e-mail enviado ao responsável!');
    }

    public function edit($id)
    {
        return view('tickets.edit', [
            'ticket' => Ticket::findOrFail($id),
            'users' => User::all(),
            'responsibleUsers' => User::all(),
            'categories' => Category::all(),
            'ticketPriorities' => TicketPriority::all(),
            'ticketStatuses' => TicketStatus::all(),
            'departments' => Department::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'fk_user_id' => 'required|exists:users,id',
            'fk_responsible_user_id' => 'nullable|exists:users,id',
            'fk_category_id' => 'required|exists:categories,id',
            'fk_ticket_status_id' => 'required|exists:ticket_statuses,id',
            'fk_department_id' => 'required|exists:departments,id',
            'fk_ticket_priority_id' => 'required|exists:ticket_priorities,id',
        ]);

        $ticket = Ticket::findOrFail($id);

        $oldStatus = $ticket->fk_ticket_status_id;
        $oldPriority = $ticket->fk_ticket_priority_id;
        $oldResponsible = $ticket->fk_responsible_user_id;

        $ticket->update($validated);

        // Envia e-mail se o responsável foi alterado
        if ($oldResponsible != $ticket->fk_responsible_user_id && $ticket->fk_responsible_user_id) {
            $newResponsible = User::find($ticket->fk_responsible_user_id);
            if ($newResponsible && $newResponsible->email) {
                Mail::to($newResponsible->email)->send(new TicketCreatedMail($ticket));
            }
        }

        // Envia e-mail se status ou prioridade foram alterados
        if ($oldStatus != $ticket->fk_ticket_status_id || $oldPriority != $ticket->fk_ticket_priority_id) {
            $emailsToNotify = [];

            if ($ticket->responsibleUser && $ticket->responsibleUser->email) {
                $emailsToNotify[] = $ticket->responsibleUser->email;
            }

            if ($ticket->user && $ticket->user->email && !in_array($ticket->user->email, $emailsToNotify)) {
                $emailsToNotify[] = $ticket->user->email;
            }

            foreach ($emailsToNotify as $email) {
                Mail::to($email)->send(new TicketUpdatedMail($ticket, $oldStatus, $oldPriority));
            }
        }

        return redirect()->route('tickets.index')->with('success', 'Ticket atualizado com sucesso!');
    }

    public function destroy($id)
    {
        Ticket::destroy($id);

        return redirect()->route('tickets.index')->with('success', 'Ticket excluído com sucesso!');
    }

    public function show($id)
    {
        $ticket = Ticket::with([
            'interactions.user',
            'responsibleUser',
            'user',
        ])->findOrFail($id);

        return view('tickets.show', compact('ticket'));
    }
}
