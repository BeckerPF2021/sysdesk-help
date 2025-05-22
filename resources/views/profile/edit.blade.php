@extends('layouts.app')

@section('title', 'Editar Perfil')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Perfil</h1>

    @if(session('status') === 'profile-updated')
        <div class="alert alert-success">Perfil atualizado com sucesso.</div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="row g-3">
            <div class="col-md-6">
                <label for="name" class="form-label">Nome</label>
                <input id="name" name="name" type="text" 
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $user->name) }}" required autofocus>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="email" class="form-label">E-mail</label>
                <input id="email" name="email" type="email" 
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="phone" class="form-label">Telefone</label>
                <input id="phone" name="phone" type="text" 
                       class="form-control @error('phone') is-invalid @enderror"
                       value="{{ old('phone', $user->phone) }}">
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="department" class="form-label">Departamento</label>
                <input id="department" name="department" type="text" 
                       class="form-control @error('department') is-invalid @enderror"
                       value="{{ old('department', $user->department) }}">
                @error('department')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="role" class="form-label">Cargo</label>
                <input id="role" name="role" type="text" 
                       class="form-control @error('role') is-invalid @enderror"
                       value="{{ old('role', $user->role) }}">
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="active" class="form-label">Status</label>
                <select id="active" name="active" class="form-control @error('active') is-invalid @enderror">
                    <option value="1" {{ old('active', $user->active) == 1 ? 'selected' : '' }}>Ativo</option>
                    <option value="0" {{ old('active', $user->active) == 0 ? 'selected' : '' }}>Inativo</option>
                </select>
                @error('active')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <hr class="my-4">

        <div class="mb-3">
            <label for="profile_picture_url" class="form-label">Foto do Perfil</label>
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
                <div class="mt-2">
                    <img src="{{ $imgSrc }}" alt="Foto atual"
                         style="max-width: 150px; max-height: 150px; border-radius: 50%;">
                </div>
            @endif
        </div>

        <hr class="my-4">

        <div class="row g-3">
            <div class="col-md-6">
                <label for="password" class="form-label">Nova senha</label>
                <input id="password" name="password" type="password" 
                       class="form-control @error('password') is-invalid @enderror" autocomplete="new-password"
                       placeholder="Deixe em branco para manter a senha atual">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="password_confirmation" class="form-label">Confirme a nova senha</label>
                <input id="password_confirmation" name="password_confirmation" type="password" 
                       class="form-control" autocomplete="new-password">
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Salvar Alterações</button>
    </form>

    <hr class="my-5">

    <form method="POST" action="{{ route('profile.destroy') }}" 
          onsubmit="return confirm('Tem certeza que deseja excluir sua conta?');">
        @csrf
        @method('DELETE')

        <div class="mb-3">
            <label for="password_delete" class="form-label">Confirme sua senha para excluir a conta</label>
            <input id="password_delete" name="password" type="password" 
                   class="form-control @error('password') is-invalid @enderror" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-danger">Excluir Conta</button>
    </form>
</div>
@endsection
