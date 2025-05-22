<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tipo de Interação</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-4">
        <h1 class="mb-4">Editar Tipo de Interação</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Erros encontrados:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('interaction-types.update', $interactionType->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nome do Tipo de Interação</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $interactionType->name) }}" required>
            </div>

            <button type="submit" class="btn btn-success">Atualizar</button>
            <a href="{{ route('interaction-types.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

</body>

</html>
