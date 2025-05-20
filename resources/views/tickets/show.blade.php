@extends('layouts.app')

@section('title', 'Detalhes do Ticket #{{ $ticket->id }}')

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

    <!-- Exibição dos detalhes do ticket -->
    <div class="mb-4 card">
        <div class="card-body">
            <h5 class="card-title">Título: {{ $ticket->title }}</h5>
            <p class="card-text"><strong>Descrição:</strong> {{ $ticket->description }}</p>
            <p class="card-text"><strong>Status:</strong> {{ $ticket->ticketStatus->name }}</p>
            <p class="card-text"><strong>Prioridade:</strong> {{ $ticket->ticketPriority->name }}</p>
            <p class="card-text"><strong>Departamento:</strong> {{ $ticket->department->name }}</p>
            <p class="card-text"><strong>Criado em:</strong> {{ $ticket->created_at->format('d/m/Y H:i') }}</p>
            <p class="card-text"><strong>Última atualização:</strong> {{ $ticket->updated_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <!-- Interações do ticket -->
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

    <!-- Link para adicionar nova interação -->
    <a href="{{ route('ticket_interactions.create', ['ticket' => $ticket->id]) }}" class="btn btn-primary">Adicionar Nova Interação</a>

    <!-- Botão para voltar para a lista de tickets -->
    <a href="{{ route('tickets.index') }}" class="mt-3 btn btn-secondary">Voltar para a Lista de Tickets</a>
</div>
@endsection
