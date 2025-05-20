<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use App\Models\Category;
use App\Models\TicketPriority;
use App\Models\TicketStatus;
use App\Models\Department;
use App\Models\TicketInteraction;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    // Exibe a lista de tickets com suas relações
    public function index()
    {
        // Inclui responsibleUser na eager loading
        $tickets = Ticket::with([
            'user', 
            'responsibleUser',  // novo relacionamento
            'category', 
            'ticketPriority', 
            'ticketStatus', 
            'department'
        ])->get();

        return view('tickets.index', compact('tickets'));
    }

    // Exibe o formulário para criar um novo ticket
    public function create()
    {
        $users = User::all();
        $categories = Category::all();
        $ticketPriorities = TicketPriority::all();
        $ticketStatuses = TicketStatus::all();
        $departments = Department::all();

        return view('tickets.create', compact(
            'users', 
            'categories', 
            'ticketPriorities', 
            'ticketStatuses', 
            'departments'
        ));
    }

    // Armazena o novo ticket
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'fk_user_id' => 'required|exists:users,id',
            'fk_responsible_user_id' => 'nullable|exists:users,id',   // novo campo
            'fk_category_id' => 'required|exists:categories,id',
            'fk_ticket_status_id' => 'required|exists:ticket_statuses,id',
            'fk_department_id' => 'required|exists:departments,id',
            'fk_ticket_priority_id' => 'required|exists:ticket_priorities,id',
        ]);

        Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'fk_user_id' => $request->fk_user_id,
            'fk_responsible_user_id' => $request->fk_responsible_user_id,  // novo campo
            'fk_category_id' => $request->fk_category_id,
            'fk_ticket_status_id' => $request->fk_ticket_status_id,
            'fk_department_id' => $request->fk_department_id,
            'fk_ticket_priority_id' => $request->fk_ticket_priority_id,
        ]);

        return redirect()->route('tickets.index')->with('success', 'Ticket criado com sucesso!');
    }

    // Exibe o formulário para editar um ticket existente
    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        $users = User::all();
        $responsibleUsers = User::all();  // lista de responsáveis para dropdown
        $categories = Category::all();
        $ticketPriorities = TicketPriority::all();
        $ticketStatuses = TicketStatus::all();
        $departments = Department::all();

        return view('tickets.edit', compact(
            'ticket', 
            'users', 
            'responsibleUsers',  // não esquecer de passar para a view
            'categories', 
            'ticketPriorities', 
            'ticketStatuses', 
            'departments'
        ));
    }

    // Atualiza o ticket existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'fk_user_id' => 'required|exists:users,id',
            'fk_responsible_user_id' => 'nullable|exists:users,id',  // novo campo
            'fk_category_id' => 'required|exists:categories,id',
            'fk_ticket_status_id' => 'required|exists:ticket_statuses,id',
            'fk_department_id' => 'required|exists:departments,id',
            'fk_ticket_priority_id' => 'required|exists:ticket_priorities,id',
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->update([
            'title' => $request->title,
            'description' => $request->description,
            'fk_user_id' => $request->fk_user_id,
            'fk_responsible_user_id' => $request->fk_responsible_user_id, // novo campo
            'fk_category_id' => $request->fk_category_id,
            'fk_ticket_status_id' => $request->fk_ticket_status_id,
            'fk_department_id' => $request->fk_department_id,
            'fk_ticket_priority_id' => $request->fk_ticket_priority_id,
        ]);

        return redirect()->route('tickets.index')->with('success', 'Ticket atualizado com sucesso!');
    }

    // Exclui um ticket
    public function destroy($id)
    {
        Ticket::destroy($id);

        return redirect()->route('tickets.index')->with('success', 'Ticket excluído com sucesso!');
    }

    // Exibe os detalhes de um ticket, incluindo as interações
    public function show($id)
    {
        $ticket = Ticket::with([
            'interactions.user',
            'responsibleUser',  // incluir responsável
        ])->findOrFail($id);

        return view('tickets.show', compact('ticket'));
    }
}
