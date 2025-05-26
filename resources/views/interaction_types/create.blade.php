<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Interação - Ticket {{ $ticket->id }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-4">
        <h1 class="mb-4">Criar Nova Interação para o Ticket #{{ $ticket->id }}</h1>

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

        <!-- A rota agora recebe o ticket ID -->
        <form action="{{ route('ticket_interactions.store', ['ticket' => $ticket->id]) }}" method="POST">
            @csrf

            <!-- O ID do ticket é passado no formulário -->
            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">

            <div class="form-group">
                <label for="text">Texto da Interação</label>
                <textarea name="text" id="text" rows="4" class="form-control" required>{{ old('text') }}</textarea>
            </div>

            <div class="form-group">
                <label for="comment_date">Data da Interação</label>
                <input type="datetime-local" name="comment_date" id="comment_date" class="form-control"
                    value="{{ old('comment_date', now()->format('Y-m-d\TH:i')) }}" required>
            </div>

            <div class="form-group">
                <label for="interaction_type">Tipo de Interação</label>
                <select name="interaction_type" id="interaction_type" class="form-control" required>
                    <option value="">Selecione o tipo</option>
                    @foreach ($interactionTypes as $type)
                        <option value="{{ $type->id }}" {{ old('interaction_type') == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="file_type">Tipo de Arquivo (opcional)</label>
                <input type="text" name="file_type" id="file_type" class="form-control" value="{{ old('file_type') }}">
            </div>

            <div class="form-group">
                <label for="file_size">Tamanho do Arquivo (bytes, opcional)</label>
                <input type="number" name="file_size" id="file_size" class="form-control" value="{{ old('file_size') }}">
            </div>

            <button type="submit" class="btn btn-success">Salvar Interação</button>
            <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

</body>

</html>
