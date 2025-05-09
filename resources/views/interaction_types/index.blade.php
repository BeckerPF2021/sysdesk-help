<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipos de Interação</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-4">
        <h1 class="mb-4">Tipos de Interação</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('interaction-types.create') }}" class="mb-3 btn btn-primary">Adicionar Novo Tipo de Interação</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($interactionTypes as $interactionType)
                    <tr>
                        <td>{{ $interactionType->id }}</td>
                        <td>{{ $interactionType->name }}</td>
                        <td>
                            <a href="{{ route('interaction-types.edit', $interactionType->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('interaction-types.destroy', $interactionType->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>
