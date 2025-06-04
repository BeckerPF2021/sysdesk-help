@extends('layouts.app')

@section('title', 'Relatório de Chamados')

@section('content')
<div class="container-fluid mt-4">
    <h2 class="text-center text-primary mb-4 fw-bold">
        <i class="fas fa-chart-line me-2"></i> Relatório de Chamados
    </h2>

    {{-- Filtros --}}
    <form action="{{ route('reports.index') }}" method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="start_date" class="form-label">Data Inicial</label>
            <input type="date" name="start_date" id="start_date" class="form-control shadow-sm" value="{{ request('start_date') }}">
        </div>
        <div class="col-md-4">
            <label for="end_date" class="form-label">Data Final</label>
            <input type="date" name="end_date" id="end_date" class="form-control shadow-sm" value="{{ request('end_date') }}">
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100 shadow-sm fw-semibold">
                <i class="fas fa-filter me-1"></i> Filtrar
            </button>
        </div>
    </form>

    {{-- Cards Resumo --}}
    <div class="row text-center mb-4">
        @foreach ([
            ['label' => 'Chamados Hoje', 'value' => $ticketsToday],
            ['label' => 'Chamados no Mês', 'value' => $ticketsMonth],
            ['label' => 'Chamados no Ano', 'value' => $ticketsYear],
            ['label' => 'Resolvidos Hoje', 'value' => $resolvedToday]
        ] as $card)
            <div class="col-md-3">
                <div class="card shadow-sm mb-3">
                    <div class="card-body">
                        <h6 class="text-muted">{{ $card['label'] }}</h6>
                        <h3 class="text-primary">{{ $card['value'] }}</h3>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Botão PDF --}}
    <div class="text-end mb-4">
        <a href="{{ route('reports.pdf', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" target="_blank" class="btn btn-danger shadow-sm">
            <i class="fas fa-file-pdf me-1"></i> Gerar PDF
        </a>
    </div>

    {{-- Tabelas de Agrupamento --}}
    @foreach ([
        ['title' => '📋 Chamados por Responsável', 'data' => $ticketsByUser, 'label' => 'responsibleUser.name', 'fallback' => 'Não atribuído', 'colTitle' => 'Responsável'],
        ['title' => '🚦 Chamados por Status', 'data' => $ticketsByStatus, 'label' => 'ticketStatus.name', 'fallback' => 'Sem Status', 'colTitle' => 'Status'],
        ['title' => '⚠️ Chamados por Prioridade', 'data' => $ticketsByPriority, 'label' => 'ticketPriority.name', 'fallback' => 'Sem Prioridade', 'colTitle' => 'Prioridade'],
        ['title' => '📂 Chamados por Categoria', 'data' => $ticketsByCategory, 'label' => 'category.name', 'fallback' => 'Sem Categoria', 'colTitle' => 'Categoria']
    ] as $section)
        <h5 class="mt-5 fw-bold">{{ $section['title'] }}</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center shadow-sm mt-2">
                <thead class="table-light">
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
        </div>
    @endforeach

    {{-- Gráfico de Status --}}
    <h5 class="mt-5 fw-bold">📊 Gráfico de Chamados por Status</h5>
    <canvas id="statusChart" class="mb-5"></canvas>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const labels = {!! json_encode($ticketsByStatus->map(fn($t) => $t->ticketStatus->name ?? 'Sem Status')) !!};
        const data = {!! json_encode($ticketsByStatus->pluck('total')) !!};

        if (labels.length > 0 && data.length > 0) {
            const ctx = document.getElementById('statusChart').getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Chamados por Status',
                        data: data,
                        backgroundColor: labels.map((_, i) => {
                            const colors = ['#007bff', '#ffc107', '#28a745', '#dc3545', '#6c757d', '#6610f2', '#20c997'];
                            return colors[i % colors.length];
                        }),
                        borderColor: '#fff',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    let label = context.label || '';
                                    let value = context.parsed || 0;
                                    return `${label}: ${value} chamado(s)`;
                                }
                            }
                        }
                    }
                }
            });
        } else {
            const container = document.getElementById('statusChart').parentNode;
            container.insertAdjacentHTML('beforeend', '<p class="text-muted text-center">Nenhum dado para exibir no gráfico.</p>');
        }
    });
</script>
@endpush