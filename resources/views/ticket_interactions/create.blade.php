@extends('layouts.app')

@section('title', 'Nova Interação - Ticket #' . $ticket->id . ' - ' . $ticket->title)

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-primary fw-bold">
        Adicionar Nova Interação ao Ticket #{{ $ticket->id }} - {{ $ticket->title }}
    </h1>

    @if ($errors->any())
        <div class="rounded shadow-sm alert alert-danger">
            <strong>Erros encontrados:</strong>
            <ul class="mt-2 mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ticket_interactions.store', $ticket->id) }}" method="POST" enctype="multipart/form-data" class="p-4 bg-white border rounded shadow-sm">
        @csrf

        <div class="mb-3">
            <label for="text" class="form-label fw-semibold">Texto da Interação <span class="text-danger">*</span></label>
            <textarea name="text" id="text" rows="5" class="form-control form-control-lg" placeholder="Descreva a interação..." required>{{ old('text') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="comment_date" class="form-label fw-semibold">Data da Interação <span class="text-danger">*</span></label>
            <input type="datetime-local" name="comment_date" id="comment_date" class="form-control form-control-lg"
                value="{{ old('comment_date', now()->format('Y-m-d\TH:i')) }}" required>
        </div>

        <div class="mb-3">
            <label for="interaction_type" class="form-label fw-semibold">Tipo de Interação <span class="text-danger">*</span></label>
            <select name="interaction_type" id="interaction_type" class="form-select form-select-lg" required>
                <option value="" disabled {{ old('interaction_type') ? '' : 'selected' }}>Selecione o tipo</option>
                @foreach ($interactionTypes as $type)
                    <option value="{{ $type->id }}" {{ old('interaction_type') == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="file" class="form-label fw-semibold">Arquivo (opcional)</label>
            <input type="file" name="file" id="file" class="form-control form-control-lg"
                accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx,.txt">
            <small class="form-text text-muted">Formatos permitidos: jpg, jpeg, png, pdf, doc, docx, xls, xlsx, txt. Máximo 10MB.</small>
        </div>

        <div class="gap-3 d-flex">
            <button type="submit" class="shadow-sm btn btn-success btn-lg">
                <i class="fas fa-save me-2"></i>Salvar Interação
            </button>
            <a href="{{ route('tickets.show', $ticket->id) }}" class="shadow-sm btn btn-outline-secondary btn-lg">
                <i class="fas fa-times me-2"></i>Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
