@extends('layouts.app')

@section('title', 'Criar Novo Status de Ticket')

@section('content')
<div class="container mt-5" style="max-width: 600px;">
    <div class="mb-4 d-flex align-items-center">
        <h1 class="mb-0 text-success fw-bold d-flex align-items-center">
            <i class="fas fa-plus me-2"></i> Criar Novo Status de Ticket
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

    {{-- Formulário de criação --}}
    <form action="{{ route('ticket-statuses.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Nome do Status</label>
            <input type="text" id="name" name="name" class="form-control form-control-lg" placeholder="Ex: Em andamento" required>
        </div>

        <div class="gap-3 d-flex">
            <button type="submit" class="px-4 btn btn-success fw-semibold">
                Criar Status
            </button>
            <a href="{{ route('ticket-statuses.index') }}" class="px-4 btn btn-secondary fw-semibold">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
