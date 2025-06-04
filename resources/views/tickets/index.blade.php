@extends('layouts.app')

@section('title', 'Tickets')

@section('content')
@php
    $groupId = Auth::user()->user_group_id;
    $statusColors = [
        'Aberto' => 'primary', 
        'Em Andamento' => 'warning', 
        'Concluído' => 'success', 
        'Cancelado' => 'danger',
        'Pendente' => 'info'
    ];
    $priorityColors = [
        'Baixa' => 'success', 
        'Média' => 'warning', 
        'Alta' => 'danger', 
        'Crítica' => 'dark'
    ];
@endphp

<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-gradient-primary border-0 shadow-lg">
                <div class="card-body text-white py-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="display-6 fw-bold mb-2">
                                <i class="fas fa-ticket-alt me-3"></i>Gestão de Tickets
                            </h1>
                            <p class="lead mb-0 opacity-75">Sistema de gerenciamento de solicitações e suporte</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('tickets.create') }}" class="btn btn-light btn-lg shadow-sm">
                                <i class="fas fa-plus me-2"></i>Novo Ticket
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if (session('success'))
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-25 rounded-circle p-2 me-3">
                            <i class="fas fa-check-circle text-success"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="alert-heading mb-1">Sucesso!</h6>
                            <p class="mb-0">{{ session('success') }}</p>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <div class="d-flex align-items-start">
                        <div class="bg-danger bg-opacity-25 rounded-circle p-2 me-3">
                            <i class="fas fa-exclamation-triangle text-danger"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="alert-heading mb-2">Atenção!</h6>
                            <p class="mb-2"><strong>Por favor, corrija os seguintes erros:</strong></p>
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Filtros de Busca -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom-0 py-4">
                    <h5 class="card-title mb-0 text-dark fw-bold">
                        <i class="fas fa-search text-primary me-2"></i>
                        Filtros de Busca
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('tickets.index') }}" method="GET" role="search">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-6">
                                <label for="search" class="form-label fw-semibold">
                                    <i class="fas fa-search me-1"></i>Buscar por título
                                </label>
                                <input
                                    type="search"
                                    name="search"
                                    id="search"
                                    value="{{ request('search', $search ?? '') }}"
                                    class="form-control"
                                    placeholder="Digite o título do ticket..."
                                    aria-label="Buscar tickets pelo título"
                                />
                            </div>
                            <div class="col-md-4">
                                <label for="status_id" class="form-label fw-semibold">
                                    <i class="fas fa-tasks me-1"></i>Status
                                </label>
                                <select name="status_id" id="status_id" class="form-select" aria-label="Filtrar por status">
                                    <option value="">Todos os Status</option>
                                    @foreach ($ticketStatuses as $status)
                                        <option value="{{ $status->id }}" @selected(request('status_id', $statusId ?? '') == $status->id)>
                                            {{ $status->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-filter me-1"></i>Filtrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @php
        $groupedTickets = $tickets->groupBy(fn($ticket) => $ticket->ticketStatus->name);
    @endphp

    @if ($tickets->count())
        <!-- Estatísticas -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body py-3">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-chart-bar text-primary fa-2x me-3"></i>
                                    <div>
                                        <h6 class="mb-1">Total de Tickets</h6>
                                        <small class="text-muted">Distribuídos por {{ $groupedTickets->count() }} status diferentes</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-end">
                                <div class="rounded-pill px-4 py-2 d-inline-block">
                                    <i class="fas fa-ticket-alt text-primary me-2"></i>
                                    <span class="fw-bold text-primary fs-5">{{ $tickets->total() }}</span>
                                    <small class="text-muted ms-1">ticket(s)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tickets Agrupados por Status -->
        @foreach ($groupedTickets as $status => $ticketsGroup)
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <!-- Card Header -->
                        <div class="card-header bg-white border-bottom-0 py-4">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h4 class="card-title mb-0 text-dark fw-bold">
                                        @php
                                            $statusColor = $statusColors[$status] ?? 'secondary';
                                        @endphp
                                        <span class="badge bg-transparent text-{{ $statusColor }} me-3 px-3 py-2">
                                            <i class="fas fa-circle me-1"></i>{{ $status }}
                                        </span>
                                        <span class="text-muted">{{ $ticketsGroup->count() }} ticket(s)</span>
                                    </h4>
                                </div>
                                <div class="col-md-4 text-end">
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar bg-{{ $statusColor }}" 
                                             style="width: {{ ($ticketsGroup->count() / $tickets->total()) * 100 }}%">
                                        </div>
                                    </div>
                                    <small class="text-muted">
                                        {{ number_format(($ticketsGroup->count() / $tickets->total()) * 100, 1) }}% do total
                                    </small>
                                </div>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0 align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="py-3 fw-semibold text-center">
                                                <i class="fas fa-hashtag text-muted me-1"></i>ID
                                            </th>
                                            <th class="py-3 fw-semibold">
                                                <i class="fas fa-tag text-muted me-1"></i>Título
                                            </th>
                                            <th class="py-3 fw-semibold">
                                                <i class="fas fa-align-left text-muted me-1"></i>Descrição
                                            </th>
                                            <th class="py-3 fw-semibold">
                                                <i class="fas fa-user text-muted me-1"></i>Solicitante
                                            </th>
                                            <th class="py-3 fw-semibold text-center">
                                                <i class="fas fa-exclamation-circle text-muted me-1"></i>Prioridade
                                            </th>
                                            <th class="py-3 fw-semibold">
                                                <i class="fas fa-building text-muted me-1"></i>Departamento
                                            </th>
                                            <th class="py-3 fw-semibold">
                                                <i class="fas fa-user-tie text-muted me-1"></i>Responsável
                                            </th>
                                            @if ($groupId === 1 || $groupId === 2)
                                                <th class="py-3 fw-semibold text-center">
                                                    <i class="fas fa-cogs text-muted me-1"></i>Ações
                                                </th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ticketsGroup as $ticket)
                                            <tr class="border-bottom">
                                                <td class="py-3 text-center">
                                                    <span class="badge bg-light text-dark fw-bold">#{{ $ticket->id }}</span>
                                                </td>
                                                <td class="py-3">
                                                    <div>
                                                        <a href="{{ route('tickets.show', $ticket->id) }}" 
                                                           class="text-primary fw-semibold text-decoration-none" 
                                                           title="{{ $ticket->title }}">
                                                            {{ \Illuminate\Support\Str::limit($ticket->title, 40) }}
                                                        </a>
                                                        <br><small class="text-muted">Clique para ver detalhes</small>
                                                    </div>
                                                </td>
                                                <td class="py-3">
                                                    <span class="text-muted">{{ \Illuminate\Support\Str::limit($ticket->description, 50) }}</span>
                                                </td>
                                                <td class="py-3">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-user text-info me-2"></i>
                                                        <div>
                                                            <div class="fw-semibold">{{ $ticket->user->name ?? '-' }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="py-3 text-center">
                                                @php
                                                    $priorityColor = $priorityColors[$ticket->ticketPriority->name] ?? 'secondary';
                                                @endphp
                                                <span class="badge text-{{ $priorityColor }} px-3 py-2" style="background-color: transparent;">
                                                    {{ $ticket->ticketPriority->name }}
                                                </span>
                                                </td>
                                                <td class="py-3">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-building text-warning me-2"></i>
                                                        <span class="fw-semibold">{{ $ticket->department->name }}</span>
                                                    </div>
                                                </td>
                                                <td class="py-3">
                                                    @if($ticket->responsibleUser)
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-user-tie text-success me-2"></i>
                                                        <div>
                                                            <div class="fw-semibold">{{ $ticket->responsibleUser->name }}</div>
                                                        </div>
                                                    </div>
                                                    @else
                                                        <span class="text-muted fst-italic">Não atribuído</span>
                                                    @endif
                                                </td>
                                                @if ($groupId === 1 || $groupId === 2)
                                                    <td class="py-3 text-center">
                                                        <div class="btn-group" role="group">
                                                            <a href="{{ route('tickets.show', $ticket->id) }}" 
                                                               class="btn btn-sm btn-outline-info" 
                                                               title="Visualizar ticket">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="{{ route('tickets.edit', $ticket->id) }}" 
                                                               class="btn btn-sm btn-outline-warning" 
                                                               title="Editar ticket">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            @if ($groupId === 1)
                                                                <button type="button" 
                                                                        class="btn btn-sm btn-outline-danger" 
                                                                        title="Excluir ticket"
                                                                        onclick="confirmDelete({{ $ticket->id }}, '{{ $ticket->title }}')">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- Paginação --}}
        @if(method_exists($tickets, 'links') && $tickets->hasPages())
            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-center">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body py-3">
                            {{ $tickets->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @else
        {{-- Estado vazio --}}
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-ticket-alt fa-4x text-muted mb-4 opacity-50"></i>
                        <h4 class="text-muted mb-3">Nenhum Ticket Encontrado</h4>
                        <p class="text-muted mb-4">Não há tickets que correspondam aos critérios de busca.</p>
                        <a href="{{ route('tickets.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Criar Primeiro Ticket
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Informações Adicionais -->
    @if ($tickets->count())
        <div class="row mt-4">
            <div class="col-12">
                <div class="card bg-light border-0">
                    <div class="card-body py-4">
                        <div class="row align-items-center">
                            <div class="col-md-2 text-center">
                                <i class="fas fa-info-circle fa-3x text-primary"></i>
                            </div>
                            <div class="col-md-8">
                                <h6 class="mb-2">Sobre o Sistema de Tickets</h6>
                                <p class="text-muted small mb-0">
                                    O sistema de tickets permite o gerenciamento eficiente de solicitações e suporte. 
                                    Os tickets são organizados por status, prioridade e departamento para facilitar o acompanhamento e resolução.
                                </p>
                            </div>
                            <div class="col-md-2 text-center">
                                <div class="row g-2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white border-0">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirmar Exclusão
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body py-4">
                <div class="text-center">
                    <i class="fas fa-ticket-alt fa-3x text-danger mb-3"></i>
                    <h6>Tem certeza que deseja excluir este ticket?</h6>
                    <p class="text-muted mb-0">
                        Ticket: <strong id="ticketTitle"></strong><br>
                        <small class="text-warning">
                            <i class="fas fa-exclamation-triangle me-1"></i>
                            Atenção: Esta ação não pode ser desfeita.
                        </small>
                    </p>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Cancelar
                </button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash-alt me-1"></i>Excluir
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
}

.table-hover tbody tr:hover {
    background-color: rgba(0, 123, 255, 0.05);
    transform: translateY(-1px);
    transition: all 0.2s ease;
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
}

.border-bottom {
    border-bottom: 1px solid rgba(0,0,0,0.1) !important;
}

.btn-group .btn {
    margin: 0 2px;
}

.progress {
    border-radius: 10px;
}

.progress-bar {
    border-radius: 10px;
}
</style>

<script>
function confirmDelete(ticketId, ticketTitle) {
    document.getElementById('ticketTitle').textContent = ticketTitle;
    document.getElementById('deleteForm').action = `/tickets/${ticketId}`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
@endsection