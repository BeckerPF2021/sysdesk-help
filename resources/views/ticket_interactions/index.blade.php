<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interações - Ticket #{{ $ticket->id }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="bg-white shadow-sm navbar navbar-expand-lg navbar-light border-bottom">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>
    </nav>

    <!-- Conteúdo -->
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

        <a href="{{ route('tickets.show', $ticket->id) }}" class="mt-3 btn btn-secondary">Voltar para Detalhes do Ticket</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
