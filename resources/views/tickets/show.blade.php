@extends('layouts.app')

@section('title', 'Detalhes do Ticket #' . $ticket->id)

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Detalhes do Ticket #{{ $ticket->id }}</h1>

    <!-- Exibição de erros -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Detalhes do ticket -->
    <div class="mb-4 card">
        <div class="card-body">
            <h5 class="card-title">Título: {{ $ticket->title }}</h5>
            <p class="card-text"><strong>Descrição:</strong> {{ $ticket->description }}</p>
            <p class="card-text"><strong>Aberto por:</strong> {{ $ticket->user->name }}</p>
            <p class="card-text"><strong>Status:</strong> {{ $ticket->ticketStatus->name }}</p>
            <p class="card-text"><strong>Prioridade:</strong> {{ $ticket->ticketPriority->name }}</p>
            <p class="card-text"><strong>Departamento:</strong> {{ $ticket->department->name }}</p>
            <p class="card-text"><strong>Responsável:</strong> 
                {{ $ticket->responsibleUser ? $ticket->responsibleUser->name : '-' }}
            </p>
            <p class="card-text"><strong>Criado em:</strong> {{ $ticket->created_at->format('d/m/Y H:i') }}</p>
            <p class="card-text"><strong>Última atualização:</strong> {{ $ticket->updated_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <!-- Interações -->
    <h3 class="mb-4">Interações</h3>

    <div class="mb-4">
        @forelse ($ticket->interactions as $interaction)
            <div class="mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">{{ $interaction->user->name }}</h5>
                    <p class="card-text">{{ $interaction->text }}</p>
                    @if ($interaction->file_type)
                        <p><strong>Arquivo:</strong> {{ $interaction->file_type }} ({{ $interaction->file_size }} KB)</p>
                    @endif
                    <small class="text-muted">{{ $interaction->created_at->diffForHumans() }}</small>
                </div>
            </div>
        @empty
            <div class="alert alert-info">Não há interações para este ticket ainda.</div>
        @endforelse
    </div>

    <!-- Ações -->
    <div class="d-flex gap-2 flex-wrap mt-4">
        <a href="{{ route('ticket_interactions.create', ['ticket' => $ticket->id]) }}" class="btn btn-primary">
            <i class="fas fa-comment-dots me-1"></i> Adicionar Interação
        </a>

        <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-warning">
            <i class="fas fa-edit me-1"></i> Editar Ticket
        </a>

        <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este ticket?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash-alt me-1"></i> Excluir Ticket
            </button>
        </form>

        <a href="{{ route('tickets.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Voltar para a Lista
        </a>
    </div>
</div>
@endsection
