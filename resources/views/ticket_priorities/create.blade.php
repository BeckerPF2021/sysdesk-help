<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Prioridade de Ticket</title>
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
        <h1 class="mb-4">Criar Nova Prioridade de Ticket</h1>

        <form action="{{ route('ticket-priorities.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nome da Prioridade</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Criar</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
