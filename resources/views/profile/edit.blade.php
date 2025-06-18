@extends('layouts.app')

@section('title', 'Editar Perfil')

@section('content')
<div class="container mt-5">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h1 class="text-primary fw-bold">
            <i class="fas fa-user-edit me-2"></i> Editar Perfil
        </h1>
        <a href="{{ route('profile.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Voltar
        </a>
    </div>

    @if(session('status') === 'profile-updated')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> Perfil atualizado com sucesso.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    @endif

    <div class="mb-4 shadow-sm card">
        <div class="card-body">
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                {{-- Nome --}}
                <div class="mb-3">
                    <label for="name" class="fw-semibold">Nome <span class="text-danger">*</span></label>
                    <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $user->name) }}" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="fw-semibold">E-mail <span class="text-danger">*</span></label>
                    <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $user->email) }}" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Telefone --}}
                <div class="mb-3">
                    <label for="phone" class="fw-semibold">Telefone</label>
                    <input id="phone" name="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                        value="{{ old('phone', $user->phone) }}">
                    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Departamento --}}
                <div class="mb-3">
                    <label for="department" class="fw-semibold">Departamento</label>
                    <input id="department" name="department" type="text" class="form-control @error('department') is-invalid @enderror"
                        value="{{ old('department', $user->department) }}">
                    @error('department') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Cargo --}}
                <div class="mb-3">
                    <label for="role" class="fw-semibold">Cargo</label>
                    <input id="role" name="role" type="text" class="form-control @error('role') is-invalid @enderror"
                        value="{{ old('role', $user->role) }}">
                    @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label for="active" class="fw-semibold">Status</label>
                    <select id="active" name="active" class="form-control @error('active') is-invalid @enderror">
                        <option value="1" {{ old('active', $user->active) == 1 ? 'selected' : '' }}>Ativo</option>
                        <option value="0" {{ old('active', $user->active) == 0 ? 'selected' : '' }}>Inativo</option>
                    </select>
                    @error('active') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Foto de perfil --}}
                <div class="mb-3">
                    <label for="profile_picture_url" class="fw-semibold">Foto de Perfil</label>
                    <input id="profile_picture_url" name="profile_picture_url" type="file" accept="image/*"
                        class="form-control @error('profile_picture_url') is-invalid @enderror">
                    @error('profile_picture_url') <div class="invalid-feedback">{{ $message }}</div> @enderror

                    @if($user->profile_picture_url)
                        <div class="mt-3 text-center">
                            <img src="{{ asset('storage/' . $user->profile_picture_url) }}" alt="Foto atual"
                                 class="rounded-circle" style="max-width: 150px; max-height: 150px;">
                        </div>
                    @endif
                </div>

                {{-- Nova senha --}}
                <div class="mb-3">
                    <label for="password" class="fw-semibold">Nova Senha</label>
                    <input id="password" name="password" type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           placeholder="Deixe em branco para manter a senha atual">
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Confirmação de senha --}}
                <div class="mb-4">
                    <label for="password_confirmation" class="fw-semibold">Confirme a Nova Senha</label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                           class="form-control">
                </div>

                {{-- Botões --}}
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-save me-1"></i> Salvar
                    </button>
                    <a href="{{ route('profile.index') }}" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

    {{-- Exclusão da conta --}}
    <div class="mt-5 shadow-sm card">
        <div class="card-header bg-danger bg-opacity-10">
            <h5 class="mb-0 text-danger">
                <i class="fas fa-exclamation-triangle me-2"></i> Zona de Perigo
            </h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('profile.destroy') }}"
                  onsubmit="return confirm('Tem certeza que deseja excluir sua conta? Esta ação é irreversível.');">
                @csrf
                @method('DELETE')

                <div class="mb-3">
                    <label for="password_delete" class="fw-semibold">Senha atual</label>
                    <input id="password_delete" name="password" type="password"
                           class="form-control @error('password') is-invalid @enderror" required>
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash-alt me-1"></i> Excluir Conta
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
