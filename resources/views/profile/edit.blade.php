@extends('layouts.app')

@section('title', 'Editar Perfil')

@section('content')
<div class="container my-5" style="max-width: 600px;">
    <h1 class="mb-4 text-center">Editar Perfil</h1>

    @if(session('status') === 'profile-updated')
        <div class="alert alert-success">Perfil atualizado com sucesso.</div>
    @endif

    <div class="card shadow-sm mb-5">
        <div class="card-body">
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="form-group mb-3">
                    <label for="name"><i class="bi bi-person-fill mr-2"></i>Nome</label>
                    <input id="name" name="name" type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $user->name) }}" required autofocus>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="email"><i class="bi bi-envelope-fill mr-2"></i>E-mail</label>
                    <input id="email" name="email" type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="phone"><i class="bi bi-telephone-fill mr-2"></i>Telefone</label>
                    <input id="phone" name="phone" type="text"
                           class="form-control @error('phone') is-invalid @enderror"
                           value="{{ old('phone', $user->phone) }}">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="department"><i class="bi bi-building mr-2"></i>Departamento</label>
                    <input id="department" name="department" type="text"
                           class="form-control @error('department') is-invalid @enderror"
                           value="{{ old('department', $user->department) }}">
                    @error('department')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="role"><i class="bi bi-briefcase-fill mr-2"></i>Cargo</label>
                    <input id="role" name="role" type="text"
                           class="form-control @error('role') is-invalid @enderror"
                           value="{{ old('role', $user->role) }}">
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label for="active"><i class="bi bi-person-check-fill mr-2"></i>Status</label>
                    <select id="active" name="active" class="form-control @error('active') is-invalid @enderror">
                        <option value="1" {{ old('active', $user->active) == 1 ? 'selected' : '' }}>Ativo</option>
                        <option value="0" {{ old('active', $user->active) == 0 ? 'selected' : '' }}>Inativo</option>
                    </select>
                    @error('active')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr>

                <div class="form-group mb-4">
                    <label for="profile_picture_url"><i class="bi bi-image-fill mr-2"></i>Foto do Perfil</label>
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

                <div class="form-group mb-3">
                    <label for="password"><i class="bi bi-lock-fill mr-2"></i>Nova senha</label>
                    <input id="password" name="password" type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           autocomplete="new-password"
                           placeholder="Deixe em branco para manter a senha atual">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label for="password_confirmation"><i class="bi bi-lock-fill mr-2"></i>Confirme a nova senha</label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                           class="form-control" autocomplete="new-password">
                </div>

                <button type="submit" class="btn btn-primary btn-block">Salvar Alterações</button>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('profile.destroy') }}" 
                  onsubmit="return confirm('Tem certeza que deseja excluir sua conta?');">
                @csrf
                @method('DELETE')

                <div class="form-group mb-3">
                    <label for="password_delete"><i class="bi bi-exclamation-triangle-fill mr-2 text-danger"></i>Confirme sua senha para excluir a conta</label>
                    <input id="password_delete" name="password" type="password"
                           class="form-control @error('password') is-invalid @enderror" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-danger btn-block">Excluir Conta</button>
            </form>
        </div>
    </div>
</div>
@endsection
