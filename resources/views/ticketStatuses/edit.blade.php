@extends('layouts.app')

@section('title', 'Editar Status de Ticket')

@section('content')
<div class="container mt-5" style="max-width: 600px;">
    <div class="mb-4 d-flex align-items-center">
        <h1 class="mb-0 text-primary fw-bold d-flex align-items-center">
            <i class="fas fa-edit me-2"></i> Editar Status de Ticket
        </h1>
    </div>

    {{-- Mensagem de erro --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    @endif

    {{-- Formulário de edição --}}
    <form action="{{ route('ticket-statuses.update', $ticketStatus->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Nome do Status</label>
            <input type="text" id="name" name="name" class="form-control form-control-lg" value="{{ old('name', $ticketStatus->name) }}" required>
        </div>

        <div class="gap-3 d-flex">
            <button type="submit" class="px-4 btn btn-primary fw-semibold">
                Atualizar
            </button>
            <a href="{{ route('ticket-statuses.index') }}" class="px-4 btn btn-secondary fw-semibold">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
