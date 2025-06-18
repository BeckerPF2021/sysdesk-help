@extends('layouts.app')

@section('title', 'Relatório de Chamados')

@section('content')
<div class="py-4 container-fluid">
    <!-- Header Section -->
    <div class="mb-4 row">
        <div class="col-12">
            <div class="border-0 shadow-lg card bg-gradient-primary">
                <div class="py-4 text-white card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="mb-2 display-6 fw-bold">
                                <i class="fas fa-chart-line me-3"></i>Relatório de Chamados
                            </h1>
                            <p class="mb-0 opacity-75 lead">Dashboard de análise e métricas do sistema SYSDESK</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('reports.pdf', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
                               target="_blank" class="shadow-sm btn btn-light btn-lg">
                                <i class="fas fa-file-pdf me-2"></i>Gerar PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros Section -->
    <div class="mb-4 row">
        <div class="col-12">
            <div class="border-0 shadow-sm card">
                <div class="py-3 bg-white card-header border-bottom-0">
                    <h5 class="mb-0 card-title text-dark fw-bold">
                        <i class="fas fa-filter text-primary me-2"></i>
                        Filtros de Período
                    </h5>
                </div>
                <div class="p-4 card-body">
                    <form action="{{ route('reports.index') }}" method="GET" class="row g-3">
                        <div class="col-md-4">
                            <label for="start_date" class="form-label fw-semibold">
                                <i class="fas fa-calendar-alt text-muted me-1"></i>Data Inicial
                            </label>
                            <input type="date" name="start_date" id="start_date"
                                   class="shadow-sm form-control" value="{{ request('start_date') }}">
                        </div>
                        <div class="col-md-4">
                            <label for="end_date" class="form-label fw-semibold">
                                <i class="fas fa-calendar-alt text-muted me-1"></i>Data Final
                            </label>
                            <input type="date" name="end_date" id="end_date"
                                   class="shadow-sm form-control" value="{{ request('end_date') }}">
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="shadow-sm btn btn-primary w-100 fw-semibold btn-lg">
                                <i class="fas fa-search me-2"></i>Aplicar Filtros
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Cards Resumo -->
    <div class="mb-5 row">
        @php
            $metricsCards = [
                [
                    'label' => 'Chamados Hoje',
                    'value' => $ticketsToday,
                    'icon' => 'fas fa-calendar-day',
                    'color' => 'primary',
                    'bg' => 'primary'
                ],
                [
                    'label' => 'Chamados no Mês',
                    'value' => $ticketsMonth,
                    'icon' => 'fas fa-calendar-alt',
                    'color' => 'info',
                    'bg' => 'info'
                ],
                [
                    'label' => 'Chamados no Ano',
                    'value' => $ticketsYear,
                    'icon' => 'fas fa-calendar',
                    'color' => 'warning',
                    'bg' => 'warning'
                ],
                [
                    'label' => 'Resolvidos Hoje',
                    'value' => $resolvedToday,
                    'icon' => 'fas fa-check-circle',
                    'color' => 'success',
                    'bg' => 'success'
                ]
            ];
        @endphp

        @foreach ($metricsCards as $card)
            <div class="col-lg-3 col-md-6">
                <div class="border-0 shadow-sm card h-100 metric-card">
                    <div class="p-4 card-body">
                        <div class="d-flex align-items-center">
                            <i class="{{ $card['icon'] }} fa-2x text-{{ $card['color'] }} me-3"></i>
                            <div class="flex-grow-1">
                                <h6 class="mb-1 text-muted fw-semibold">{{ $card['label'] }}</h6>
                                <h2 class="mb-0 text-{{ $card['color'] }} fw-bold">{{ $card['value'] }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Tabelas de Agrupamento -->
    @php
        $reportSections = [
            [
                'title' => 'Chamados por Responsável',
                'icon' => 'fas fa-users',
                'data' => $ticketsByUser,
                'label' => 'responsibleUser.name',
                'fallback' => 'Não atribuído',
                'colTitle' => 'Responsável',
                'color' => 'primary',
                'itemIcon' => 'fas fa-user'
            ],
            [
                'title' => 'Chamados por Status',
                'icon' => 'fas fa-traffic-light',
                'data' => $ticketsByStatus,
                'label' => 'ticketStatus.name',
                'fallback' => 'Sem Status',
                'colTitle' => 'Status',
                'color' => 'info',
                'itemIcon' => 'fas fa-flag'
            ],
            [
                'title' => 'Chamados por Prioridade',
                'icon' => 'fas fa-exclamation-triangle',
                'data' => $ticketsByPriority,
                'label' => 'ticketPriority.name',
                'fallback' => 'Sem Prioridade',
                'colTitle' => 'Prioridade',
                'color' => 'warning',
                'itemIcon' => 'fas fa-exclamation'
            ],
            [
                'title' => 'Chamados por Categoria',
                'icon' => 'fas fa-folder-open',
                'data' => $ticketsByCategory,
                'label' => 'category.name',
                'fallback' => 'Sem Categoria',
                'colTitle' => 'Categoria',
                'color' => 'success',
                'itemIcon' => 'fas fa-folder'
            ]
        ];
    @endphp

    @foreach ($reportSections as $section)
        <div class="mb-4 row">
            <div class="col-12">
                <div class="border-0 shadow-sm card">
                    <div class="py-3 bg-white card-header border-bottom-0">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h5 class="mb-0 card-title text-dark fw-bold">
                                    <i class="{{ $section['icon'] }} text-{{ $section['color'] }} me-2"></i>
                                    {{ $section['title'] }}
                                </h5>
                            </div>
                            <div class="col-md-6 text-end">
                                <div class="px-3 py-2 bg-light rounded-pill d-inline-block">
                                    <i class="fas fa-chart-bar me-2"></i>
                                    <span class="fw-semibold">{{ $section['data']->count() }}</span>
                                    <small class="text-muted ms-1">item(s)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-0 card-body">
                        <div class="table-responsive">
                            <table class="table mb-0 align-middle table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th class="py-3 fw-semibold">
                                            <i class="fas fa-tag text-muted me-1"></i>{{ $section['colTitle'] }}
                                        </th>
                                        <th class="py-3 text-center fw-semibold">
                                            <i class="fas fa-hashtag text-muted me-1"></i>Total de Chamados
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($section['data'] as $item)
                                        <tr class="border-bottom">
                                            <td class="py-3">
                                                <div class="d-flex align-items-center">
                                                    <i class="{{ $section['itemIcon'] }} text-{{ $section['color'] }} me-3"></i>
                                                    <span class="fw-semibold">{{ data_get($item, $section['label'], $section['fallback']) }}</span>
                                                </div>
                                            </td>
                                            <td class="py-3 text-center">
                                                <span class="fw-bold">
                                                    {{ $item->total }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="py-5 text-center">
                                                <div class="text-muted">
                                                    <i class="mb-3 opacity-50 fas fa-chart-bar fa-3x"></i>
                                                    <h6>Nenhum dado encontrado</h6>
                                                    <p class="mb-0">Não há registros para o período selecionado.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- <!-- Gráficos Section -->
    <div class="mb-4 row">
        <!-- Gráfico de Status -->
        <div class="col-lg-6">
            <div class="border-0 shadow-sm card h-100">
                <div class="py-3 bg-white card-header border-bottom-0">
                    <h5 class="mb-0 card-title text-dark fw-bold">
                        <i class="fas fa-chart-pie text-primary me-2"></i>
                        Chamados por Status
                    </h5>
                </div>
                <div class="p-4 card-body">
                    <div class="position-relative" style="height: 350px;">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráfico de Prioridade -->
        <div class="col-lg-6">
            <div class="border-0 shadow-sm card h-100">
                <div class="py-3 bg-white card-header border-bottom-0">
                    <h5 class="mb-0 card-title text-dark fw-bold">
                        <i class="fas fa-chart-bar text-warning me-2"></i>
                        Chamados por Prioridade
                    </h5>
                </div>
                <div class="p-4 card-body">
                    <div class="position-relative" style="height: 350px;">
                        <canvas id="priorityChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico de Categoria -->
    <div class="mb-4 row">
        <div class="col-12">
            <div class="border-0 shadow-sm card">
                <div class="py-3 bg-white card-header border-bottom-0">
                    <h5 class="mb-0 card-title text-dark fw-bold">
                        <i class="fas fa-chart-line text-success me-2"></i>
                        Chamados por Categoria
                    </h5>
                </div>
                <div class="p-4 card-body">
                    <div class="position-relative" style="height: 400px;">
                        <canvas id="categoryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Info Section -->
    <div class="mt-4 row">
        <div class="col-12">
            <div class="border-0 card bg-light">
                <div class="py-4 card-body">
                    <div class="row align-items-center">
                        <div class="text-center col-md-2">
                            <i class="fas fa-info-circle fa-3x text-primary"></i>
                        </div>
                        <div class="col-md-8">
                            <h6 class="mb-2">Sobre os Relatórios</h6>
                            <p class="mb-0 text-muted small">
                                Os relatórios fornecem uma visão completa das métricas de chamados do sistema.
                                Use os filtros de período para análises específicas e exporte os dados em PDF quando necessário.
                            </p>
                        </div>
                        <div class="text-center col-md-2">
                            <div class="row g-2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
}

.metric-card {
    transition: all 0.3s ease;
    border-left: 4px solid transparent;
}

.metric-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
}

.table-hover tbody tr:hover {
    background-color: rgba(0, 123, 255, 0.05);
    transform: translateY(-1px);
    transition: all 0.2s ease;
}

.card {
    transition: all 0.3s ease;
}

.border-bottom {
    border-bottom: 1px solid rgba(0,0,0,0.1) !important;
}

/* Estilos para os gráficos */
.chart-container {
    position: relative;
    margin: auto;
}

canvas {
    max-width: 100% !important;
    height: auto !important;
}

.no-data-message {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 300px;
    text-align: center;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Script carregado - iniciando criação dos gráficos');

    // Verificar se Chart.js foi carregado
    if (typeof Chart === 'undefined') {
        console.error('Chart.js não foi carregado corretamente');
        return;
    }

    // Dados do PHP - estrutura corrigida baseada no debug
    const statusData = @json($ticketsByStatus ?? []);
    const priorityData = @json($ticketsByPriority ?? []);
    const categoryData = @json($ticketsByCategory ?? []);

    console.log('Dados recebidos:');
    console.log('Status:', statusData);
    console.log('Priority:', priorityData);
    console.log('Category:', categoryData);

    // Função para mostrar mensagem de sem dados
    function showNoDataMessage(canvasId, title) {
        const canvas = document.getElementById(canvasId);
        if (canvas && canvas.parentNode) {
            canvas.parentNode.innerHTML = `
                <div class="no-data-message">
                    <i class="mb-3 opacity-50 fas fa-chart-pie fa-3x text-muted"></i>
                    <h6 class="text-muted">Nenhum dado disponível</h6>
                    <p class="mb-0 text-muted">Não há dados suficientes para ${title}.</p>
                </div>
            `;
        }
    }

    // Função genérica para criar gráfico
    function createChart(canvasId, chartConfig, title) {
        try {
            const canvas = document.getElementById(canvasId);
            if (!canvas) {
                console.error(`Canvas ${canvasId} não encontrado`);
                return;
            }

            const ctx = canvas.getContext('2d');
            return new Chart(ctx, chartConfig);
        } catch (error) {
            console.error(`Erro ao criar gráfico ${canvasId}:`, error);
            showNoDataMessage(canvasId, title);
        }
    }

    // ======================= GRÁFICO DE STATUS =======================
    function createStatusChart() {
        let statusLabels = [];
        let statusValues = [];

        if (Array.isArray(statusData) && statusData.length > 0) {
            statusData.forEach(item => {
                // Acesso correto baseado na estrutura do Eloquent
                let statusName = 'Sem Status';

                // Verificar se o relacionamento foi carregado corretamente
                if (item.ticket_status && item.ticket_status.name) {
                    statusName = item.ticket_status.name;
                } else if (item.ticketStatus && item.ticketStatus.name) {
                    statusName = item.ticketStatus.name;
                }

                statusLabels.push(statusName);
                statusValues.push(parseInt(item.total) || 0);
            });

            console.log('Status processado:', { labels: statusLabels, values: statusValues });

            if (statusValues.some(v => v > 0)) {
                createChart('statusChart', {
                    type: 'doughnut',
                    data: {
                        labels: statusLabels,
                        datasets: [{
                            label: 'Chamados por Status',
                            data: statusValues,
                            backgroundColor: [
                                '#007bff', '#28a745', '#ffc107', '#dc3545', '#17a2b8', '#6c757d'
                            ],
                            borderColor: '#ffffff',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 15,
                                    usePointStyle: true
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        const percentage = ((context.parsed / total) * 100).toFixed(1);
                                        return `${context.label}: ${context.parsed} (${percentage}%)`;
                                    }
                                }
                            }
                        }
                    }
                }, 'gráfico de status');
            } else {
                showNoDataMessage('statusChart', 'gráfico de status');
            }
        } else {
            showNoDataMessage('statusChart', 'gráfico de status');
        }
    }

    // ======================= GRÁFICO DE PRIORIDADE =======================
    function createPriorityChart() {
        let priorityLabels = [];
        let priorityValues = [];

        if (Array.isArray(priorityData) && priorityData.length > 0) {
            priorityData.forEach(item => {
                let priorityName = 'Sem Prioridade';

                if (item.ticket_priority && item.ticket_priority.name) {
                    priorityName = item.ticket_priority.name;
                } else if (item.ticketPriority && item.ticketPriority.name) {
                    priorityName = item.ticketPriority.name;
                }

                priorityLabels.push(priorityName);
                priorityValues.push(parseInt(item.total) || 0);
            });

            console.log('Priority processado:', { labels: priorityLabels, values: priorityValues });

            if (priorityValues.some(v => v > 0)) {
                createChart('priorityChart', {
                    type: 'bar',
                    data: {
                        labels: priorityLabels,
                        datasets: [{
                            label: 'Chamados por Prioridade',
                            data: priorityValues,
                            backgroundColor: ['#dc3545', '#ffc107', '#28a745', '#007bff'],
                            borderColor: ['#dc3545', '#ffc107', '#28a745', '#007bff'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        }
                    }
                }, 'gráfico de prioridade');
            } else {
                showNoDataMessage('priorityChart', 'gráfico de prioridade');
            }
        } else {
            showNoDataMessage('priorityChart', 'gráfico de prioridade');
        }
    }

    // ======================= GRÁFICO DE CATEGORIA =======================
    function createCategoryChart() {
        let categoryLabels = [];
        let categoryValues = [];

        if (Array.isArray(categoryData) && categoryData.length > 0) {
            categoryData.forEach(item => {
                let categoryName = 'Sem Categoria';

                if (item.category && item.category.name) {
                    categoryName = item.category.name;
                }

                categoryLabels.push(categoryName);
                categoryValues.push(parseInt(item.total) || 0);
            });

            console.log('Category processado:', { labels: categoryLabels, values: categoryValues });

            if (categoryValues.some(v => v > 0)) {
                createChart('categoryChart', {
                    type: 'bar',
                    data: {
                        labels: categoryLabels,
                        datasets: [{
                            label: 'Chamados por Categoria',
                            data: categoryValues,
                            backgroundColor: ['#28a745', '#007bff', '#17a2b8', '#ffc107', '#dc3545'],
                            borderColor: ['#28a745', '#007bff', '#17a2b8', '#ffc107', '#dc3545'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            x: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        }
                    }
                }, 'gráfico de categoria');
            } else {
                showNoDataMessage('categoryChart', 'gráfico de categoria');
            }
        } else {
            showNoDataMessage('categoryChart', 'gráfico de categoria');
        }
    }

    // Criar todos os gráficos
    createStatusChart();
    createPriorityChart();
    createCategoryChart();

    console.log('Finalizado carregamento dos gráficos');
});
</script>
@endpush
