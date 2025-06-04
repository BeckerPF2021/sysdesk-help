@extends('layouts.app')

@section('title', 'Criar Novo Usuário')

@section('content')
<div class="container mt-5">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h1 class="text-primary fw-bold">
            <i class="fas fa-user-plus me-2"></i> Criar Novo Usuário
        </h1>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">
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
            <form action="{{ route('users.store') }}" method="POST" novalidate>
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="mb-3 form-group">
                            <label for="name" class="fw-semibold">
                                <i class="fas fa-user me-2"></i> Nome <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="name" name="name" 
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}" placeholder="Digite o nome do usuário" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3 form-group">
                            <label for="email" class="fw-semibold">
                                <i class="fas fa-envelope me-2"></i> E-mail <span class="text-danger">*</span>
                            </label>
                            <input type="email" id="email" name="email" 
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" placeholder="Digite o e-mail do usuário" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3 form-group">
                            <label for="password" class="fw-semibold">
                                <i class="fas fa-lock me-2"></i> Senha <span class="text-danger">*</span>
                            </label>
                            <input type="password" id="password" name="password" 
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Digite a senha" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3 form-group">
                            <label for="password_confirmation" class="fw-semibold">
                                <i class="fas fa-lock me-2"></i> Confirmar Senha <span class="text-danger">*</span>
                            </label>
                            <input type="password" id="password_confirmation" name="password_confirmation" 
                                   class="form-control"
                                   placeholder="Confirme a senha" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-4 form-group">
                            <label for="user_group_id" class="fw-semibold">
                                <i class="fas fa-users-cog me-2"></i> Grupo de Usuário <span class="text-danger">*</span>
                            </label>
                            <select id="user_group_id" name="user_group_id" 
                                    class="form-control @error('user_group_id') is-invalid @enderror" required>
                                <option value="" disabled selected>Selecione um grupo</option>
                                @foreach ($userGroups as $group)
                                    <option value="{{ $group->id }}" {{ old('user_group_id') == $group->id ? 'selected' : '' }}>
                                        {{ $group->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_group_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-save me-1"></i> Criar Usuário
                    </button>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
