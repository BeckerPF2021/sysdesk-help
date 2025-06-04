<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Carbon\Carbon;
use PDF;

class ReportController extends Controller
{
    private function getReportData($startDate = null, $endDate = null)
    {
        $today = Carbon::today();
        $monthStart = Carbon::now()->startOfMonth();
        $yearStart = Carbon::now()->startOfYear();
        $generatedAt = Carbon::now()->format('d/m/Y H:i:s');

        $filteredQuery = Ticket::query();
        if ($startDate && $endDate) {
            $filteredQuery->whereBetween('created_at', [$startDate, $endDate]);
        }

        return [
            'ticketsToday' => $filteredQuery->clone()->whereDate('created_at', $today)->count(),
            'ticketsMonth' => $filteredQuery->clone()->whereBetween('created_at', [$monthStart, now()])->count(),
            'ticketsYear'  => $filteredQuery->clone()->whereBetween('created_at', [$yearStart, now()])->count(),

            'resolvedToday' => $filteredQuery->clone()->whereDate('updated_at', $today)
                ->whereHas('ticketStatus', fn($q) => $q->where('name', 'Resolvido'))
                ->count(),

            'ticketsByUser' => $filteredQuery->clone()
                ->selectRaw('fk_responsible_user_id, COUNT(*) as total')
                ->groupBy('fk_responsible_user_id')
                ->with('responsibleUser')
                ->get(),

            'ticketsByStatus' => $filteredQuery->clone()
                ->selectRaw('fk_ticket_status_id, COUNT(*) as total')
                ->groupBy('fk_ticket_status_id')
                ->with('ticketStatus')
                ->get(),

            'ticketsByPriority' => $filteredQuery->clone()
                ->selectRaw('fk_ticket_priority_id, COUNT(*) as total')
                ->groupBy('fk_ticket_priority_id')
                ->with('ticketPriority')
                ->get(),

            'ticketsByCategory' => $filteredQuery->clone()
                ->selectRaw('fk_category_id, COUNT(*) as total')
                ->groupBy('fk_category_id')
                ->with('category')
                ->get(),

            // Dados brutos para o gráfico (nome do status + total)
            'chartData' => $filteredQuery->clone()
                ->selectRaw('fk_ticket_status_id, COUNT(*) as total')
                ->groupBy('fk_ticket_status_id')
                ->with('ticketStatus:id,name') // importante para o gráfico
                ->get(),

            'generatedAt' => $generatedAt,
        ];
    }

    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $data = $this->getReportData($startDate, $endDate);

        return view('reports.index', $data);
    }

    public function pdf(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $data = $this->getReportData($startDate, $endDate);

        $pdf = PDF::loadView('reports.pdf', $data);

        return $pdf->stream('relatorio-chamados.pdf');
    }
}