@extends('layouts.app')

@section('title', 'Nova Interação - Ticket #' . $ticket->id)

@section('content')

    <h1 class="mb-4">Adicionar Nova Interação ao Ticket #{{ $ticket->id }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Erros encontrados:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tickets.interactions.store', $ticket->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="fk_ticket_id" value="{{ $ticket->id }}">
        <input type="hidden" name="fk_user_id" value="{{ auth()->id() }}">

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
            <label for="file">Arquivo (opcional)</label>
            <input type="file" name="file" id="file" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Salvar Interação</button>
        <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-secondary">Cancelar</a>
    </form>

@endsection
