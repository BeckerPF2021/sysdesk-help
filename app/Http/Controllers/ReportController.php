<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF; // Alias para Barryvdh\DomPDF\Facade\Pdf

class ReportController extends Controller
{
    /**
     * Coleta e retorna os dados necessários para o relatório.
     */
    private function getReportData()
    {
        $today = Carbon::today();
        $monthStart = Carbon::now()->startOfMonth();
        $yearStart = Carbon::now()->startOfYear();

        // Data/hora da geração formatada
        $generatedAt = Carbon::now()->format('d/m/Y H:i:s');

        return [
            'ticketsToday' => Ticket::whereDate('created_at', $today)->count(),
            'ticketsMonth' => Ticket::whereBetween('created_at', [$monthStart, now()])->count(),
            'ticketsYear'  => Ticket::whereBetween('created_at', [$yearStart, now()])->count(),

            'resolvedToday' => Ticket::whereDate('updated_at', $today)
                                     ->whereHas('ticketStatus', fn($q) => $q->where('name', 'Resolvido'))
                                     ->count(),

            'ticketsByUser' => Ticket::selectRaw('fk_responsible_user_id, COUNT(*) as total')
                                     ->groupBy('fk_responsible_user_id')
                                     ->with('responsibleUser')
                                     ->get(),

            'ticketsByStatus' => Ticket::selectRaw('fk_ticket_status_id, COUNT(*) as total')
                                       ->groupBy('fk_ticket_status_id')
                                       ->with('ticketStatus')
                                       ->get(),

            'ticketsByPriority' => Ticket::selectRaw('fk_ticket_priority_id, COUNT(*) as total')
                                         ->groupBy('fk_ticket_priority_id')
                                         ->with('ticketPriority')
                                         ->get(),

            'ticketsByCategory' => Ticket::selectRaw('fk_category_id, COUNT(*) as total')
                                         ->groupBy('fk_category_id')
                                         ->with('category')
                                         ->get(),

            'generatedAt' => $generatedAt,  // adiciona a data/hora
        ];
    }

    /**
     * Exibe a página do relatório.
     */
    public function index()
    {
        $data = $this->getReportData();
        return view('reports.index', $data);
    }

    /**
     * Gera e retorna o relatório em PDF.
     */
    public function pdf()
    {
        $data = $this->getReportData();

        $pdf = PDF::loadView('reports.pdf', $data);

        return $pdf->stream('relatorio-chamados.pdf');
        // return $pdf->download('relatorio-chamados.pdf');
    }
}
