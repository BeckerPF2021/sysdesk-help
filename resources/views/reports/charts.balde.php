@extends('layouts.app')

@section('title', 'Relatório Gráfico de Chamados')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">📊 Relatório Gráfico de Chamados</h2>

    <div class="row">
        <!-- Gráfico de Chamados por Status (aberto, fechado, resolvido, etc) -->
        <div class="mb-4 col-md-6">
            <h4 class="text-center">Chamados por Status</h4>
            <canvas id="statusChart"></canvas>
        </div>

        <!-- Gráfico de Chamados por Prioridade -->
        <div class="mb-4 col-md-6">
            <h4 class="text-center">Chamados por Prioridade</h4>
            <canvas id="priorityChart"></canvas>
        </div>

        <!-- Gráfico de Chamados por Responsável -->
        <div class="mb-4 col-md-6">
            <h4 class="text-center">Chamados por Responsável</h4>
            <canvas id="userChart"></canvas>
        </div>

        <!-- Gráfico de Chamados por Categoria -->
        <div class="mb-4 col-md-6">
            <h4 class="text-center">Chamados por Categoria</h4>
            <canvas id="categoryChart"></canvas>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Função auxiliar para gerar cores aleatórias
function getRandomColors(num) {
    const colors = [];
    for (let i = 0; i < num; i++) {
        const color = `hsl(${Math.floor(Math.random() * 360)}, 70%, 60%)`;
        colors.push(color);
    }
    return colors;
}

// Dados para Status
const statusLabels = {
    !!json_encode($ticketsByStatus - > map(fn($item) => $item - > ticketStatus - > name ?? 'Sem Status')) !!
};
const statusData = {
    !!json_encode($ticketsByStatus - > pluck('total')) !!
};
const statusColors = getRandomColors(statusLabels.length);

const ctxStatus = document.getElementById('statusChart').getContext('2d');
new Chart(ctxStatus, {
    type: 'doughnut',
    data: {
        labels: statusLabels,
        datasets: [{
            data: statusData,
            backgroundColor: statusColors,
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});

// Dados para Prioridade
const priorityLabels = {
    !!json_encode($ticketsByPriority - > map(fn($item) => $item - > ticketPriority - > name ?? 'Sem Prioridade')) !!
};
const priorityData = {
    !!json_encode($ticketsByPriority - > pluck('total')) !!
};
const priorityColors = getRandomColors(priorityLabels.length);

const ctxPriority = document.getElementById('priorityChart').getContext('2d');
new Chart(ctxPriority, {
    type: 'pie',
    data: {
        labels: priorityLabels,
        datasets: [{
            data: priorityData,
            backgroundColor: priorityColors,
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});

// Dados para Responsável
const userLabels = {
    !!json_encode($ticketsByUser - > map(fn($item) => $item - > responsibleUser - > name ?? 'Não atribuído')) !!
};
const userData = {
    !!json_encode($ticketsByUser - > pluck('total')) !!
};
const userColors = getRandomColors(userLabels.length);

const ctxUser = document.getElementById('userChart').getContext('2d');
new Chart(ctxUser, {
    type: 'bar',
    data: {
        labels: userLabels,
        datasets: [{
            label: 'Chamados',
            data: userData,
            backgroundColor: userColors,
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                precision: 0
            }
        },
        plugins: {
            legend: {
                display: false
            }
        }
    }
});

// Dados para Categoria
const categoryLabels = {
    !!json_encode($ticketsByCategory - > map(fn($item) => $item - > category - > name ?? 'Sem Categoria')) !!
};
const categoryData = {
    !!json_encode($ticketsByCategory - > pluck('total')) !!
};
const categoryColors = getRandomColors(categoryLabels.length);

const ctxCategory = document.getElementById('categoryChart').getContext('2d');
new Chart(ctxCategory, {
    type: 'horizontalBar',
    data: {
        labels: categoryLabels,
        datasets: [{
            label: 'Chamados',
            data: categoryData,
            backgroundColor: categoryColors,
        }]
    },
    options: {
        indexAxis: 'y',
        responsive: true,
        scales: {
            x: {
                beginAtZero: true,
                precision: 0
            }
        },
        plugins: {
            legend: {
                display: false
            }
        }
    }
});
</script>
@endpush