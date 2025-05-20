@extends('layouts.app')

@section('title', 'Editar Perfil')

@section('content')
<div class="container">
    <h1>Editar Perfil</h1>

    @if(session('status') === 'profile-updated')
        <div class="alert alert-success">
            Perfil atualizado com sucesso.
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="name">Nome</label>
            <input id="name" name="name" type="text" 
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $user->name) }}" required autofocus>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input id="email" name="email" type="email" 
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email', $user->email) }}" required>
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Campos para alterar a senha -->
        <div class="form-group mt-3">
            <label for="password">Nova senha (deixe em branco para manter a senha atual)</label>
            <input id="password" name="password" type="password" 
                   class="form-control @error('password') is-invalid @enderror" autocomplete="new-password">
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirme a nova senha</label>
            <input id="password_confirmation" name="password_confirmation" type="password" 
                   class="form-control" autocomplete="new-password">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Salvar</button>
    </form>

    <hr>

    <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Tem certeza que deseja excluir sua conta?');">
        @csrf
        @method('DELETE')

        <div class="form-group">
            <label for="password_delete">Confirme sua senha para deletar a conta</label>
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
