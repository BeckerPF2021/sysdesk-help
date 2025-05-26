<?php

namespace App\Http\Controllers;

use App\Models\TicketStatus;
use Illuminate\Http\Request;

class TicketStatusController extends Controller
{
    public function index()
    {
        $ticketStatuses = TicketStatus::all(); // Pegue todos os status de tickets
        return view('ticketStatuses.index', compact('ticketStatuses'));
    }

    public function create()
    {
        return view('ticketStatuses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:ticket_statuses,name',
        ]);

        TicketStatus::create([
            'name' => $request->name,
        ]);

        return redirect()->route('ticket-statuses.index')->with('success', 'Ticket Status created successfully.');
    }

    public function edit(TicketStatus $ticketStatus)
    {
        return view('ticketStatuses.edit', compact('ticketStatus'));
    }

    public function update(Request $request, TicketStatus $ticketStatus)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:ticket_statuses,name,' . $ticketStatus->id,
        ]);

        $ticketStatus->update([
            'name' => $request->name,
        ]);

        return redirect()->route('ticket-statuses.index')->with('success', 'Ticket Status updated successfully.');
    }

    public function destroy(TicketStatus $ticketStatus)
    {
        $ticketStatus->delete();
        return redirect()->route('ticket-statuses.index')->with('success', 'Ticket Status deleted successfully.');
    }
}