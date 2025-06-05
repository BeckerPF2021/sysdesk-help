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

    {{-- Mensagens de sucesso --}}
    @if(session('status') === 'profile-updated')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <strong>Sucesso!</strong> Perfil atualizado com sucesso.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    @endif

    {{-- Formulário principal --}}
    <div class="shadow-sm card mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="mb-3 form-group">
                    <label for="name" class="fw-semibold"><i class="fas fa-user me-2"></i>Nome <span class="text-danger">*</span></label>
                    <input id="name" name="name" type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $user->name) }}" required autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-group">
                    <label for="email" class="fw-semibold"><i class="fas fa-envelope me-2"></i>E-mail <span class="text-danger">*</span></label>
                    <input id="email" name="email" type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-group">
                    <label for="phone" class="fw-semibold"><i class="fas fa-phone me-2"></i>Telefone</label>
                    <input id="phone" name="phone" type="text"
                           class="form-control @error('phone') is-invalid @enderror"
                           value="{{ old('phone', $user->phone) }}">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-group">
                    <label for="department" class="fw-semibold"><i class="fas fa-building me-2"></i>Departamento</label>
                    <input id="department" name="department" type="text"
                           class="form-control @error('department') is-invalid @enderror"
                           value="{{ old('department', $user->department) }}">
                    @error('department')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-group">
                    <label for="role" class="fw-semibold"><i class="fas fa-briefcase me-2"></i>Cargo</label>
                    <input id="role" name="role" type="text"
                           class="form-control @error('role') is-invalid @enderror"
                           value="{{ old('role', $user->role) }}">
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4 form-group">
                    <label for="active" class="fw-semibold"><i class="fas fa-toggle-on me-2"></i>Status</label>
                    <select id="active" name="active" class="form-control @error('active') is-invalid @enderror">
                        <option value="1" {{ old('active', $user->active) == 1 ? 'selected' : '' }}>Ativo</option>
                        <option value="0" {{ old('active', $user->active) == 0 ? 'selected' : '' }}>Inativo</option>
                    </select>
                    @error('active')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr>

                <div class="mb-4 form-group">
                    <label for="profile_picture_url" class="fw-semibold"><i class="fas fa-image me-2"></i>Foto do Perfil</label>
                    <input id="profile_picture_url" name="profile_picture_url" type="file"
                           class="form-control @error('profile_picture_url') is-invalid @enderror">
                    @error('profile_picture_url')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror

                    @php
                        use Illuminate\Support\Str;
                        $imgSrc = null;
                        if ($user->profile_picture_url) {
                            $imgSrc = Str::startsWith($user->profile_picture_url, '/storage')
                                ? asset($user->profile_picture_url)
                                : asset('storage/' . ltrim($user->profile_picture_url, '/'));
                        }
                    @endphp

                    @if($imgSrc)
                        <div class="mt-3 text-center">
                            <img src="{{ $imgSrc }}" alt="Foto atual"
                                 style="max-width: 150px; max-height: 150px; border-radius: 50%; box-shadow: 0 0 8px rgba(0,0,0,0.15);">
                        </div>
                    @endif
                </div>

                <hr>

                <div class="mb-3 form-group">
                    <label for="password" class="fw-semibold"><i class="fas fa-lock me-2"></i>Nova senha</label>
                    <input id="password" name="password" type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           autocomplete="new-password"
                           placeholder="Deixe em branco para manter a senha atual">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4 form-group">
                    <label for="password_confirmation" class="fw-semibold"><i class="fas fa-lock me-2"></i>Confirme a nova senha</label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                           class="form-control" autocomplete="new-password">
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-save me-1"></i> Salvar Alterações
                    </button>
                    <a href="{{ route('profile.index') }}" class="btn btn-outline-secondary">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Seção de exclusão de conta --}}
    <div class="shadow-sm card">
        <div class="card-header bg-danger bg-opacity-10">
            <h5 class="mb-0 text-danger">
                <i class="fas fa-exclamation-triangle me-2"></i> Zona de Perigo
            </h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('profile.destroy') }}" 
                  onsubmit="return confirm('Tem certeza que deseja excluir sua conta?');">
                @csrf
                @method('DELETE')

                <div class="mb-3 form-group">
                    <label for="password_delete" class="fw-semibold"><i class="fas fa-exclamation-triangle me-2 text-danger"></i>Confirme sua senha para excluir a conta</label>
                    <input id="password_delete" name="password" type="password"
                           class="form-control @error('password') is-invalid @enderror" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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