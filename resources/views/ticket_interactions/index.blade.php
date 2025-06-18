@extends('layouts.app')

@section('title', 'Interações - Ticket #{{ $ticket->id }}')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Interações do Ticket #{{ $ticket->id }}</h1>

    <!-- Exibição das interações -->
    <div class="mb-4">
        @forelse ($ticketInteractions as $interaction)
            <div class="mb-2 card">
                <div class="card-body">
                    <h5 class="card-title">{{ $interaction->user->name }}</h5>
                    <p class="card-text">{{ $interaction->text }}</p>
                    <small class="text-muted">{{ $interaction->created_at->diffForHumans() }}</small>
                </div>
            </div>
        @empty
            <div class="alert alert-info">Não há interações para este ticket ainda.</div>
        @endforelse
    </div>

    <!-- Link para adicionar uma nova interação -->
    <a href="{{ route('ticket_interactions.create', $ticket->id) }}" class="btn btn-primary">Adicionar Nova Interação</a>

    <!-- Link para voltar aos detalhes do ticket -->
    <a href="{{ route('tickets.show', $ticket->id) }}" class="mt-3 btn btn-secondary">Voltar para Detalhes do Ticket</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<script>

@endsection
