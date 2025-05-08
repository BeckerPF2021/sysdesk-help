<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use App\Models\Category;
use App\Models\TicketPriority;
use App\Models\TicketStatus;
use App\Models\Department;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with(['user', 'category', 'ticketPriority', 'ticketStatus', 'department'])->get();
        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        $users = User::all();
        $categories = Category::all();
        $ticketPriorities = TicketPriority::all();
        $ticketStatuses = TicketStatus::all();
        $departments = Department::all();
        return view('tickets.create', compact('users', 'categories', 'ticketPriorities', 'ticketStatuses', 'departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'fk_User_id' => 'required|exists:users,id',
            'fk_Category_id' => 'required|exists:categories,id',
            'fk_TicketPriority_id' => 'required|exists:ticket_priorities,id',
            'fk_TicketStatus_id' => 'required|exists:ticket_statuses,id',
            'fk_Department_id' => 'required|exists:departments,id',
        ]);

        Ticket::create($request->all());

        return redirect()->route('tickets.index')->with('success', 'Ticket criado com sucesso!');
    }

    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id);
        $users = User::all();
        $categories = Category::all();
        $ticketPriorities = TicketPriority::all();
        $ticketStatuses = TicketStatus::all();
        $departments = Department::all();
        return view('tickets.edit', compact('ticket', 'users', 'categories', 'ticketPriorities', 'ticketStatuses', 'departments'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'fk_User_id' => 'required|exists:users,id',
            'fk_Category_id' => 'required|exists:categories,id',
            'fk_TicketPriority_id' => 'required|exists:ticket_priorities,id',
            'fk_TicketStatus_id' => 'required|exists:ticket_statuses,id',
            'fk_Department_id' => 'required|exists:departments,id',
        ]);

        $ticket = Ticket::findOrFail($id);
        $ticket->update($request->all());

        return redirect()->route('tickets.index')->with('success', 'Ticket atualizado com sucesso!');
    }

    public function destroy($id)
    {
        Ticket::destroy($id);

        return redirect()->route('tickets.index')->with('success', 'Ticket excluído com sucesso!');
    }
}