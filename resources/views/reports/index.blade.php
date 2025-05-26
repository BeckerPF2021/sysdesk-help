@extends('layouts.app')

@section('title', 'Relatório de Chamados')

@section('content')
<div class="mt-4 container-fluid">
    <h2 class="mb-4 text-center">📈 Relatório de Chamados</h2>

    <!-- Filtros -->
    <form action="{{ route('reports.index') }}" method="GET" class="mb-4 row g-3">
        <div class="col-md-4">
            <label for="start_date">Data Inicial</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
        </div>
        <div class="col-md-4">
            <label for="end_date">Data Final</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
        </div>
    </form>

    <!-- Resumo em Cards -->
    <div class="text-center row">
        @foreach ([
            ['label' => 'Chamados Hoje', 'value' => $ticketsToday],
            ['label' => 'Chamados no Mês', 'value' => $ticketsMonth],
            ['label' => 'Chamados no Ano', 'value' => $ticketsYear],
            ['label' => 'Resolvidos Hoje', 'value' => $resolvedToday]
        ] as $card)
            <div class="col-md-3">
                <div class="mb-3 shadow-sm card">
                    <div class="card-body">
                        <h5>{{ $card['label'] }}</h5>
                        <h2 class="text-primary">{{ $card['value'] }}</h2>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Botão PDF com filtros na query -->
    <div class="mb-4 text-end">
        <a href="{{ route('reports.pdf', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" target="_blank" class="btn btn-danger">
            📄 Gerar Relatório em PDF
        </a>
    </div>

    <!-- Tabelas -->
    @foreach ([
        ['title' => '📋 Chamados por Responsável', 'data' => $ticketsByUser, 'label' => 'responsibleUser.name', 'fallback' => 'Não atribuído', 'colTitle' => 'Responsável'],
        ['title' => '🚦 Chamados por Status', 'data' => $ticketsByStatus, 'label' => 'ticketStatus.name', 'fallback' => 'Sem Status', 'colTitle' => 'Status'],
        ['title' => '⚠️ Chamados por Prioridade', 'data' => $ticketsByPriority, 'label' => 'ticketPriority.name', 'fallback' => 'Sem Prioridade', 'colTitle' => 'Prioridade'],
        ['title' => '📂 Chamados por Categoria', 'data' => $ticketsByCategory, 'label' => 'category.name', 'fallback' => 'Sem Categoria', 'colTitle' => 'Categoria']
    ] as $section)
        <h4 class="mt-5">{{ $section['title'] }}</h4>
        <table class="table mt-2 table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>{{ $section['colTitle'] }}</th>
                    <th>Total de Chamados</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($section['data'] as $item)
                    <tr>
                        <td>{{ data_get($item, $section['label'], $section['fallback']) }}</td>
                        <td>{{ $item->total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach

    <!-- Gráfico de Chamados por Status -->
    <h4 class="mt-5">📊 Gráfico de Chamados por Status</h4>
    <canvas id="statusChart" class="mb-5"></canvas>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('statusChart').getContext('2d');
    const statusChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: {!! json_encode($ticketsByStatus->pluck('ticketStatus.name')) !!},
            datasets: [{
                label: 'Total',
                data: {!! json_encode($ticketsByStatus->pluck('total')) !!},
                backgroundColor: ['#007bff', '#ffc107', '#28a745', '#dc3545', '#6c757d'],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' },
                tooltip: { enabled: true }
            }
        }
    });
</script>
@endpush
