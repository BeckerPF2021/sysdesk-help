@extends('layouts.app')

@section('title', 'Editar Departamento')

@section('content')
<div class="container mt-5">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <h1 class="mb-3 text-primary fw-bold">
            <i class="fas fa-building me-2"></i> Editar Departamento
        </h1>
        <a href="{{ route('departments.index') }}" class="btn btn-secondary shadow-sm fw-semibold mb-3">
            <i class="fas fa-arrow-left me-1"></i> Voltar à Lista
        </a>
    </div>

    {{-- Mensagens de erro --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Por favor, corrija os erros:</strong>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    @endif

    <section class="mb-5">
        <div class="p-4 bg-white rounded shadow-sm">
            <form method="POST" action="{{ route('departments.update', $department->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Nome do Departamento</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control"
                        value="{{ old('name', $department->name) }}"
                        required
                        autofocus
                    >
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary fw-semibold">
                        Atualizar Departamento
                    </button>
                    <a href="{{ route('departments.index') }}" class="btn btn-secondary fw-semibold">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection