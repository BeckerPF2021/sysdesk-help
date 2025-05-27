@extends('layouts.app')

@section('title', 'Detalhes do Ticket: ' . $ticket->title)

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-primary">Ticket #{{ $ticket->id }} - {{ $ticket->title }}</h1>

    <!-- Exibição de erros -->
    @if ($errors->any())
        <div class="rounded shadow-sm alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li><i class="fas fa-exclamation-circle me-2"></i>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Detalhes do ticket -->
    <div class="mb-5 border-0 shadow-sm card">
        <div class="text-white card-header bg-primary">
            <h5 class="mb-0">Informações do Ticket</h5>
        </div>
        <div class="card-body">
            <h4 class="mb-3 card-title">{{ $ticket->title }}</h4>
            <p class="card-text fs-5"><strong>Descrição:</strong></p>
            <p class="card-text ps-3 border-start border-3 border-primary">{{ $ticket->description }}</p>

            <div class="mt-4 row">
                <div class="mb-2 col-md-6"><strong>Aberto por:</strong> {{ $ticket->user->name }}</div>

                <div class="mb-2 col-md-6"><strong>Status:</strong>
                    <span class="badge
                        @if(strtolower($ticket->ticketStatus->name) === 'urgente')
                            bg-danger
                        @elseif(strtolower($ticket->ticketStatus->name) === 'em atendimento')
                            bg-success
                        @else
                            bg-secondary
                        @endif
                    ">
                        {{ $ticket->ticketStatus->name }}
                    </span>
                </div>

                <div class="mb-2 col-md-6"><strong>Prioridade:</strong>
                    <span class="badge bg-info">
                        {{ $ticket->ticketPriority->name }}
                    </span>
                </div>

                <div class="mb-2 col-md-6"><strong>Departamento:</strong> {{ $ticket->department->name }}</div>

                <div class="mb-2 col-md-6"><strong>Responsável:</strong>
                    {{ $ticket->responsibleUser ? $ticket->responsibleUser->name : '-' }}
                </div>

                <div class="mb-2 col-md-6"><strong>Criado em:</strong> {{ $ticket->created_at->format('d/m/Y H:i') }}</div>

                <div class="col-md-6"><strong>Última atualização:</strong> {{ $ticket->updated_at->format('d/m/Y H:i') }}</div>
            </div>
        </div>
    </div>

    <!-- Interações -->
    <h3 class="mb-4 text-secondary">Interações</h3>

    @if($ticket->interactions->isEmpty())
        <div class="rounded shadow-sm alert alert-info">Não há interações para este ticket ainda.</div>
    @else
        <div class="mb-5 shadow-sm list-group">
            @foreach ($ticket->interactions as $interaction)
                <div class="mb-3 border rounded list-group-item list-group-item-action flex-column align-items-start border-primary">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1 text-primary">{{ $interaction->user->name }}</h5>
                        <small class="text-muted">{{ $interaction->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="mb-1">{{ $interaction->text }}</p>
                    @if ($interaction->file_path)
                        <small class="text-muted">
                            <i class="fas fa-file me-1"></i>
                            Arquivo:
                            <a href="{{ route('ticket_interactions.download', ['ticket' => $ticket->id, 'ticketInteraction' => $interaction->id]) }}"
                               target="_blank"
                               rel="noopener noreferrer"
                            >
                                {{ basename($interaction->file_path) }}
                            </a>
                            ({{ number_format($interaction->file_size / 1024, 2) }} KB)
                        </small>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    <!-- Ações -->
    <div class="flex-wrap gap-3 d-flex justify-content-start">
        <a href="{{ route('ticket_interactions.create', ['ticket' => $ticket->id]) }}" class="shadow-sm btn btn-primary">
            <i class="fas fa-comment-dots me-2"></i>Adicionar Interação
        </a>

        <a href="{{ route('tickets.edit', $ticket->id) }}" class="text-white shadow-sm btn btn-warning">
            <i class="fas fa-edit me-2"></i>Editar Ticket
        </a>

        <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este ticket?');" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="shadow-sm btn btn-danger">
                <i class="fas fa-trash-alt me-2"></i>Excluir Ticket
            </button>
        </form>

        <a href="{{ route('tickets.index') }}" class="shadow-sm btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Voltar para a Lista
        </a>
    </div>
</div>
@endsection
