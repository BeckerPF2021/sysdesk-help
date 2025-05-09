<?php

namespace App\Http\Controllers;

use App\Models\TicketInteraction;
use App\Models\User;
use App\Models\Ticket;
use App\Models\InteractionType;
use Illuminate\Http\Request;

class TicketInteractionController extends Controller
{
    public function index()
    {
        // Carregar as interações mais recentes e paginar
        $interactions = TicketInteraction::with(['user', 'ticket', 'interactionType'])->latest()->paginate(10);
        return view('ticket_interactions.index', compact('interactions'));
    }

    public function create(Ticket $ticket)
    {
        // Carregar dados necessários para a criação de uma interação
        $users = User::all();
        $interactionTypes = InteractionType::all();
        return view('ticket_interactions.create', compact('ticket', 'users', 'interactionTypes'));
    }

    public function store(Request $request, Ticket $ticket)
    {
        // Validação dos dados da interação
        $validated = $request->validate([
            'text' => 'required|string',
            'comment_date' => 'required|date',
            'interaction_type' => 'required|exists:interaction_types,id',
            'file_type' => 'nullable|string|max:100',
            'file_size' => 'nullable|integer',
            'user_id' => 'required|exists:users,id',
            'ticket_id' => 'required|exists:tickets,id', // Este campo já é garantido pela rota
        ]);

        // Adicionar o ticket_id automaticamente (não precisa ser fornecido no formulário)
        $validated['ticket_id'] = $ticket->id;

        // Criar a interação no banco de dados
        TicketInteraction::create($validated);

        // Redirecionar para a página de interações do ticket
        return redirect()->route('ticket_interactions.index', ['ticket' => $ticket->id])
            ->with('success', 'Interação registrada com sucesso.');
    }

    public function show(TicketInteraction $ticketInteraction)
    {
        // Exibir detalhes da interação
        return view('ticket_interactions.show', compact('ticketInteraction'));
    }

    public function edit(TicketInteraction $ticketInteraction)
    {
        // Carregar dados necessários para edição
        $users = User::all();
        $tickets = Ticket::all();
        $interactionTypes = InteractionType::all();
        return view('ticket_interactions.edit', compact('ticketInteraction', 'users', 'tickets', 'interactionTypes'));
    }

    public function update(Request $request, TicketInteraction $ticketInteraction)
    {
        // Validação dos dados da interação
        $validated = $request->validate([
            'text' => 'required|string',
            'comment_date' => 'required|date',
            'interaction_type' => 'required|exists:interaction_types,id',
            'file_type' => 'nullable|string|max:100',
            'file_size' => 'nullable|integer',
            'user_id' => 'required|exists:users,id',
            'ticket_id' => 'required|exists:tickets,id', // Este campo também pode ser opcional ou mantido, mas você pode removê-lo se não necessário
        ]);

        // Atualizar a interação com os dados validados
        $ticketInteraction->update($validated);

        // Redirecionar para a página de interações com a mensagem de sucesso
        return redirect()->route('ticket_interactions.index')
            ->with('success', 'Interação atualizada com sucesso.');
    }

    public function destroy(TicketInteraction $ticketInteraction)
    {
        // Remover a interação
        $ticketInteraction->delete();

        // Redirecionar para a página de interações com a mensagem de sucesso
        return redirect()->route('ticket_interactions.index')
            ->with('success', 'Interação removida com sucesso.');
    }
}
