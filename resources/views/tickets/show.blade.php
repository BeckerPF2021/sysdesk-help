@extends('layouts.app')

@section('title', 'Detalhes do Ticket: ' . $ticket->title)

@section('content')
@php
    $statusColors = [
        'Aberto' => 'primary',
        'Em Andamento' => 'warning',
        'Concluído' => 'success',
        'Cancelado' => 'danger',
        'Pendente' => 'info',
        'Urgente' => 'danger',
        'Em Atendimento' => 'success'
    ];
    $priorityColors = [
        'Baixa' => 'success',
        'Média' => 'warning',
        'Alta' => 'danger',
        'Crítica' => 'dark'
    ];
@endphp

<div class="py-4 container-fluid">
    <!-- Header Section -->
    <div class="mb-4 row">
        <div class="col-12">
            <div class="border-0 shadow-lg card bg-gradient-primary">
                <div class="py-4 text-white card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="mb-2 display-6 fw-bold">
                                <i class="fas fa-ticket-alt me-3"></i>Ticket #{{ $ticket->id }}
                            </h1>
                            <p class="mb-0 opacity-75 lead">{{ $ticket->title }}</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="flex-wrap gap-2 d-flex justify-content-end">
                                @php
                                    $statusColor = $statusColors[strtolower($ticket->ticketStatus->name)] ?? 'secondary';
                                @endphp
                                <span class="badge bg- text-{{ $statusColor }} px-3 py-2 fs-6">
                                    <i class="fas fa-circle me-1"></i>{{ $ticket->ticketStatus->name }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if ($errors->any())
        <div class="mb-4 row">
            <div class="col-12">
                <div class="border-0 shadow-sm alert alert-danger alert-dismissible fade show" role="alert">
                    <div class="d-flex align-items-start">
                        <div class="p-2 bg-opacity-25 bg-danger rounded-circle me-3">
                            <i class="fas fa-exclamation-triangle text-danger"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-2 alert-heading">Atenção!</h6>
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

    <!-- Ticket Details Card -->
    <div class="mb-4 row">
        <div class="col-12">
            <div class="border-0 shadow-sm card">
                <div class="py-4 bg-white card-header border-bottom-0">
                    <h4 class="mb-0 card-title text-dark fw-bold">
                        <i class="fas fa-info-circle text-primary me-2"></i>
                        Informações do Ticket
                    </h4>
                </div>
    <div class="p-4 card-body">
        <div class="mb-4 row">
            <div class="col-12">
                <h5 class="mb-3 text-dark">{{ $ticket->title }}</h5>
                <div class="p-4 border-4 bg-light rounded-3 border-start border-primary">
                    <h6 class="mb-2 text-muted">
                        <i class="fas fa-align-left me-2"></i>Descrição
                    </h6>
                    <p class="mb-0 text-dark">{{ $ticket->description }}</p>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="p-3 bg-light rounded-3">
                    <small class="text-muted d-block">
                        <i class="fas fa-user me-1"></i> Aberto por
                    </small>
                    <span class="fw-semibold">{{ $ticket->user->name }}</span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-3 bg-light rounded-3">
                    <small class="d-block text-muted">
                        <i class="fas fa-info-circle me-1"></i> Status
                    </small>
                    @php
                        $statusColor = $statusColors[strtolower($ticket->ticketStatus->name)] ?? 'secondary';
                    @endphp
                    <span class="px-3 py-2 text-{{ $statusColor }} fw-bold">
                        {{ strtoupper($ticket->ticketStatus->name) }}
                    </span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-3 bg-light rounded-3">
                    <small class="d-block text-muted">
                        <i class="fas fa-flag me-1"></i> Prioridade
                    </small>
                    @php
                        $priorityColor = $priorityColors[$ticket->ticketPriority->name] ?? 'secondary';
                    @endphp
                    <span class="px-3 py-2 text-{{ $priorityColor }} fw-bold">
                        {{ strtoupper($ticket->ticketPriority->name) }}
                    </span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-3 bg-light rounded-3">
                    <small class="text-muted d-block">
                        <i class="fas fa-building me-1"></i> Departamento
                    </small>
                    <span class="fw-semibold">{{ $ticket->department->name }}</span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-3 bg-light rounded-3">
                    <small class="text-muted d-block">
                        <i class="fas fa-user-check me-1"></i> Responsável
                    </small>
                    <span class="fw-semibold">
                        {{ $ticket->responsibleUser ? $ticket->responsibleUser->name : 'Não atribuído' }}
                    </span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-3 bg-light rounded-3">
                    <small class="text-muted d-block">
                        <i class="fas fa-calendar-plus me-1"></i> Criado em
                    </small>
                    <span class="fw-semibold">{{ $ticket->created_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="p-3 bg-light rounded-3">
                    <small class="text-muted d-block">
                        <i class="fas fa-history me-1"></i> Última atualização
                    </small>
                    <span class="fw-semibold">{{ $ticket->updated_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>
        </div>
    </div>


    <!-- Interactions Section -->
    @foreach ($ticket->interactions as $interaction)
        <div class="mb-3 border-0 shadow-sm card">
            <div class="card-body">
                <div class="mb-2 d-flex justify-content-between align-items-start">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-user text-primary me-2"></i>
                        <div>
                            <h6 class="mb-0 text-primary fw-bold">{{ $interaction->user->name }}</h6>
                            <small class="text-muted">{{ $interaction->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
                <div class="ps-3">
                    <p class="mb-2">{{ $interaction->text }}</p>
                    @if ($interaction->file_path)
                        <div class="p-3 mt-3 bg-light rounded-3 border-start border-success border-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-file-alt text-success me-2"></i>
                                <div class="flex-grow-1">
                                    <strong>Arquivo anexado:</strong>
                                    <a href="{{ route('ticket_interactions.download', ['ticket' => $ticket->id, 'ticketInteraction' => $interaction->id]) }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="text-success fw-semibold text-decoration-none ms-2">
                                        {{ basename($interaction->file_path) }}
                                    </a>
                                    <small class="text-muted d-block">
                                        ({{ number_format($interaction->file_size / 1024, 2) }} KB)
                                    </small>
                                </div>
                                <a href="{{ route('ticket_interactions.download', ['ticket' => $ticket->id, 'ticketInteraction' => $interaction->id]) }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="btn btn-outline-success btn-sm"
                                title="Baixar arquivo">
                                    <i class="fas fa-download"></i>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach


    <!-- Action Buttons -->
    <div class="row">
        <div class="col-12">
            <div class="border-0 shadow-sm card">
                <div class="p-4 card-body">
                    <div class="flex-wrap gap-3 d-flex">
                        <a href="{{ route('ticket_interactions.create', ['ticket' => $ticket->id]) }}"
                           class="shadow-sm btn btn-primary">
                            <i class="fas fa-comment-dots me-2"></i>Adicionar Interação
                        </a>

                        <a href="{{ route('tickets.edit', $ticket->id) }}"
                           class="shadow-sm btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Editar Ticket
                        </a>

                        <form action="{{ route('tickets.destroy', $ticket->id) }}"
                              method="POST"
                              onsubmit="return confirm('Tem certeza que deseja excluir este ticket?');"
                              class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="shadow-sm btn btn-danger">
                                <i class="fas fa-trash-alt me-2"></i>Excluir Ticket
                            </button>
                        </form>

                        <a href="{{ route('tickets.index') }}"
                           class="shadow-sm btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Voltar para a Lista
                        </a>
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

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
}

.btn {
    transition: all 0.2s ease;
}

.btn:hover {
    transform: translateY(-1px);
}

.timeline .card {
    position: relative;
    margin-left: 20px;
}

.timeline .card:before {
    content: '';
    position: absolute;
    left: -10px;
    top: 20px;
    width: 4px;
    height: calc(100% + 20px);
    background: linear-gradient(to bottom, #007bff, #0056b3);
    border-radius: 2px;
}

.timeline .card:last-child:before {
    height: 50px;
}

.gap-3 {
    gap: 1rem !important;
}

@media (max-width: 768px) {
    .d-flex.gap-3 {
        flex-direction: column;
    }

    .btn {
        width: 100%;
    }
}
</style>
@endsection
