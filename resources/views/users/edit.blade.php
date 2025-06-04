@extends('layouts.app')

@section('title', 'Editar Usuário')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 fw-semibold text-primary">
        <i class="fas fa-user-edit me-2"></i> Editar Usuário
    </h1>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <strong>Erros encontrados:</strong>
            <ul class="mt-2 mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('users.update', $user->id) }}" novalidate>
        @csrf
        @method('PUT')

        <div class="row g-4">
            <div class="col-md-6">
                <label for="name" class="form-label fw-semibold">
                    <i class="fas fa-user me-1"></i> Nome <span class="text-danger">*</span>
                </label>
                <input type="text" id="name" name="name"
                       class="form-control form-control-lg"
                       value="{{ old('name', $user->name) }}"
                       required>
            </div>

            <div class="col-md-6">
                <label for="email" class="form-label fw-semibold">
                    <i class="fas fa-envelope me-1"></i> E-mail <span class="text-danger">*</span>
                </label>
                <input type="email" id="email" name="email"
                       class="form-control form-control-lg"
                       value="{{ old('email', $user->email) }}"
                       required>
            </div>

            <div class="col-md-6">
                <label for="user_group_id" class="form-label fw-semibold">
                    <i class="fas fa-users-cog me-1"></i> Grupo de Usuário <span class="text-danger">*</span>
                </label>
                <select id="user_group_id" name="user_group_id" class="form-select form-select-lg" required>
                    <option value="" disabled>Selecione um grupo</option>
                    @foreach ($groups as $group)
                        <option value="{{ $group->id }}"
                            {{ $user->user_group_id == $group->id ? 'selected' : '' }}>
                            {{ $group->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label for="password" class="form-label fw-semibold">
                    <i class="fas fa-lock me-1"></i> Nova Senha
                    <small class="text-muted">(opcional)</small>
                </label>
                <input type="password" id="password" name="password"
                       class="form-control form-control-lg"
                       placeholder="Deixe em branco para manter a senha atual">
            </div>

            <div class="col-md-6">
                <label for="password_confirmation" class="form-label fw-semibold">
                    <i class="fas fa-lock me-1"></i> Confirmar Nova Senha
                </label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                       class="form-control form-control-lg"
                       placeholder="Confirme a nova senha">
            </div>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('users.index') }}" class="btn btn-lg btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Cancelar
            </a>
            <button type="submit" class="btn btn-lg btn-primary">
                <i class="fas fa-save me-2"></i> Atualizar Usuário
            </button>
        </div>
    </form>
</div>
@endsection
