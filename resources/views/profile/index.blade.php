@extends('layouts.app')

@section('title', 'Perfil do Usuário')

@section('content')
<div class="container">
    <h1 class="mb-4">Perfil do Usuário</h1>

    <div class="text-center mb-4">
        <img 
            src="{{ $user->profile_picture_url }}" 
            alt="Foto do usuário" 
            class="rounded-circle shadow-sm" 
            width="120" 
            height="120"
        />
    </div>

    <ul class="list-group mb-4">
        <li class="list-group-item"><strong>Nome:</strong> {{ $user->name }}</li>
        <li class="list-group-item"><strong>E-mail:</strong> {{ $user->email }}</li>
        <li class="list-group-item"><strong>Telefone:</strong> {{ $user->phone ?: 'Não informado' }}</li>
        <li class="list-group-item"><strong>Departamento:</strong> {{ $user->department ?: 'Não informado' }}</li>
        <li class="list-group-item"><strong>Cargo:</strong> {{ $user->role ?: 'Não informado' }}</li>
        <li class="list-group-item"><strong>Status:</strong> 
            <span class="badge {{ $user->active ? 'bg-success' : 'bg-secondary' }}">
                {{ $user->active ? 'Ativo' : 'Inativo' }}
            </span>
        </li>
        <li class="list-group-item"><strong>Criado em:</strong> {{ $user->created_at?->format('d/m/Y H:i') }}</li>
        <li class="list-group-item"><strong>Última atualização:</strong> {{ $user->updated_at?->format('d/m/Y H:i') }}</li>
        <li class="list-group-item"><strong>Último login:</strong> 
            {{ $user->last_login_at ? $user->last_login_at->format('d/m/Y H:i') : 'Nunca logado' }}
        </li>
    </ul>

    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Editar Perfil</a>
</div>
@endsection
