@extends('layouts.app')

@section('title', 'Perfil do Usuário')

@section('content')
<div class="container my-5">
    <h1 class="mb-4 text-center">Perfil do Usuário</h1>

    <div class="mx-auto shadow-sm card" style="max-width: 480px;">
        <div class="text-center card-body">
            <img
                src="{{ $user->profile_picture_url ?: 'https://picsum.photos/120' }}"
                alt="Foto do usuário"
                class="mb-3 shadow rounded-circle"
                width="120"
                height="120"
            />
            <h3 class="mb-1 card-title">{{ $user->name }}</h3>
            <p class="mb-3 text-muted">{{ $user->role ?: 'Cargo não informado' }}</p>

            <ul class="text-left list-group list-group-flush">
                <li class="list-group-item d-flex align-items-center">
                    <i class="mr-2 bi bi-envelope-fill text-primary"></i>
                    <strong>E-mail:</strong>
                    <span class="ml-auto">{{ $user->email }}</span>
                </li>
                <li class="list-group-item d-flex align-items-center">
                    <i class="mr-2 bi bi-telephone-fill text-success"></i>
                    <strong>Telefone:</strong>
                    <span class="ml-auto">{{ $user->phone ?: 'Não informado' }}</span>
                </li>
                <li class="list-group-item d-flex align-items-center">
                    <i class="mr-2 bi bi-building text-info"></i>
                    <strong>Departamento:</strong>
                    <span class="ml-auto">{{ $user->department ?: 'Não informado' }}</span>
                </li>
                <li class="list-group-item d-flex align-items-center">
                    <i class="mr-2 bi bi-people-fill text-secondary"></i>
                    <strong>Grupo de Usuário:</strong>
                    <span class="ml-auto">{{ $user->userGroup->name ?? 'Não informado' }}</span>
                </li>
                <li class="list-group-item d-flex align-items-center">
                    <i class="bi bi-person-check-fill mr-2 {{ $user->active ? 'text-success' : 'text-secondary' }}"></i>
                    <strong>Status:</strong>
                    <span class="ml-auto badge {{ $user->active ? 'badge-success' : 'badge-secondary' }}">
                        {{ $user->active ? 'Ativo' : 'Inativo' }}
                    </span>
                </li>
                <li class="list-group-item d-flex align-items-center">
                    <i class="mr-2 bi bi-calendar-plus-fill text-warning"></i>
                    <strong>Criado em:</strong>
                    <span class="ml-auto">{{ $user->created_at?->format('d/m/Y H:i') }}</span>
                </li>
                <li class="list-group-item d-flex align-items-center">
                    <i class="mr-2 bi bi-calendar-check-fill text-primary"></i>
                    <strong>Última atualização:</strong>
                    <span class="ml-auto">{{ $user->updated_at?->format('d/m/Y H:i') }}</span>
                </li>
            </ul>

            <a href="{{ route('profile.edit') }}" class="px-4 mt-4 btn btn-primary">Editar Perfil</a>
        </div>
    </div>
</div>
@endsection
