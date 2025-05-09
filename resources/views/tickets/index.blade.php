<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tickets</title>
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
        <h1 class="mb-4">Lista de Tickets</h1>

        <!-- Mensagem de sucesso -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

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

        <a href="{{ route('tickets.create') }}" class="mb-4 btn btn-primary">Criar Novo Ticket</a>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th>Prioridade</th>
                    <th>Departamento</th>
                    <th>Ações</th>
                    <th>Interações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->id }}</td>
                        <td>
                            <!-- Atualização do link para exibir os detalhes do ticket -->
                            <a href="{{ route('tickets.show', $ticket->id) }}">
                                {{ $ticket->title }}
                            </a>
                        </td>
                        <td>{{ $ticket->description }}</td>
                        <td>{{ $ticket->ticketStatus->name }}</td>
                        <td>{{ $ticket->ticketPriority->name }}</td>
                        <td>{{ $ticket->department->name }}</td>
                        <td>
                            <!-- Ação de editar -->
                            <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-warning" aria-label="Editar Ticket">Editar</a>

                            <!-- Ação de excluir -->
                            <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir este ticket?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" aria-label="Excluir Ticket">Excluir</button>
                            </form>
                        </td>
                        <td>
                            <!-- Link para adicionar interação no ticket -->
                            <a href="{{ route('ticket_interactions.create', $ticket->id) }}" class="btn btn-primary btn-sm" aria-label="Adicionar Interação">Adicionar Interação</a>
                            <!-- Link para visualizar interações do ticket -->
                            <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-info btn-sm" aria-label="Ver Interações">Ver Interações</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Nenhum ticket encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
