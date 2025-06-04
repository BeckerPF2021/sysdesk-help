@extends('layouts.app')

@section('title', 'Criar Grupo de Usuário')

@section('content')
<div class="container mt-5">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h1 class="text-primary fw-bold">
            <i class="fas fa-users-cog me-2"></i> Criar Grupo de Usuário
        </h1>
        <a href="{{ route('user-groups.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Voltar
        </a>
    </div>

    {{-- Mensagens de erro --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Erros encontrados:</strong>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    @endif

    {{-- Formulário --}}
    <div class="shadow-sm card">
        <div class="card-body">
            <form method="POST" action="{{ route('user-groups.store') }}">
                @csrf
                <div class="mb-3 form-group">
                    <label for="name" class="fw-semibold">Nome do Grupo <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="mb-4 form-group">
                    <label for="description" class="fw-semibold">Descrição</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-save me-1"></i> Criar Grupo
                    </button>
                    <a href="{{ route('user-groups.index') }}" class="btn btn-outline-secondary">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
