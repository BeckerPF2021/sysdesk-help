@extends('layouts.app')

@section('title', 'Nova Interação - Ticket #' . $ticket->id . ' - ' . $ticket->title)

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-primary fw-bold">
        <i class="fas fa-comment-dots me-2"></i>
        Adicionar Nova Interação ao Ticket #{{ $ticket->id }} - {{ $ticket->title }}
    </h1>

    @if ($errors->any())
        <div class="alert alert-danger rounded shadow-sm">
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

        <div class="mb-4">
            <label for="text" class="form-label fw-semibold">
                <i class="fas fa-align-left me-1"></i>
                Texto da Interação <span class="text-danger">*</span>
            </label>
            <textarea name="text" id="text" rows="5" class="form-control form-control-lg" placeholder="Descreva a interação..." required>{{ old('text') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="comment_date" class="form-label fw-semibold">
                <i class="fas fa-calendar-alt me-1"></i>
                Data da Interação <span class="text-danger">*</span>
            </label>
            <input type="datetime-local" name="comment_date" id="comment_date" class="form-control form-control-lg"
                value="{{ old('comment_date', now()->format('Y-m-d\TH:i')) }}" required>
        </div>

        <div class="mb-4">
            <label for="interaction_type" class="form-label fw-semibold">
                <i class="fas fa-tags me-1"></i>
                Tipo de Interação <span class="text-danger">*</span>
            </label>
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
            <label for="file" class="form-label fw-semibold">
                <i class="fas fa-file-upload me-1"></i>
                Arquivo (opcional)
            </label>
            <input type="file" name="file" id="file" class="form-control form-control-lg"
                accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx,.txt">
            <small class="form-text text-muted">
                Formatos permitidos: jpg, jpeg, png, pdf, doc, docx, xls, xlsx, txt. Máximo 10MB.
            </small>
        </div>

        <div class="d-flex gap-3">
            <button type="submit" class="btn btn-success btn-lg shadow-sm px-4">
                <i class="fas fa-save me-2"></i> Salvar Interação
            </button>
            <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-outline-secondary btn-lg shadow-sm px-4">
                <i class="fas fa-times me-2"></i> Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
