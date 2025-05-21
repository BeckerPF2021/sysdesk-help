<?php

namespace App\Http\Controllers;

use App\Models\TicketPriority;
use Illuminate\Http\Request;

class TicketPriorityController extends Controller
{
    public function index()
    {
        $ticketPriorities = TicketPriority::all();
        return view('ticket_priorities.index', compact('ticketPriorities'));
    }

    public function create()
    {
        return view('ticket_priorities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:ticket_priorities',
        ]);

        TicketPriority::create($request->all());

        return redirect()->route('ticket-priorities.index')->with('success', 'Prioridade criada com sucesso!');
    }

    public function edit($id)
    {
        $ticketPriority = TicketPriority::findOrFail($id);
        return view('ticket_priorities.edit', compact('ticketPriority'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:ticket_priorities,name,' . $id,
        ]);

        $ticketPriority = TicketPriority::findOrFail($id);
        $ticketPriority->update($request->all());

        return redirect()->route('ticket-priorities.index')->with('success', 'Prioridade atualizada com sucesso!');
    }

    public function destroy($id)
    {
        TicketPriority::destroy($id);

        return redirect()->route('ticket-priorities.index')->with('success', 'Prioridade excluída com sucesso!');
    }
}
