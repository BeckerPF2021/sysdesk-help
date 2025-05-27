@extends('layouts.app')

@section('title', 'Grupos de Usuários')

@section('content')
@php
    $groupId = Auth::user()->user_group_id;
@endphp

<div class="mt-4 container-fluid">
    <h1 class="mb-4 text-center">Grupos de Usuários</h1>

    {{-- Mensagens de feedback --}}
    @if (session('success'))
        <div class="text-center alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Ação: Adicionar novo grupo (somente admin) --}}
    @if ($groupId === 1)
        <div class="mb-4 text-center">
            <a href="{{ route('user-groups.create') }}" class="btn btn-primary">Adicionar Novo Grupo</a>
        </div>
    @endif

    {{-- Grupos exibidos por tipo de usuário --}}
    <div class="row">
        @forelse ($userGroups as $group)
            <div class="mb-4 col-md-6 col-lg-4">
                <div class="shadow-sm card h-100">

                    {{-- Cabeçalho personalizado por grupo --}}
                    <div class="card-header d-flex justify-content-between align-items-center
                        @if ($groupId === 1)
                            bg-success text-white
                        @elseif ($groupId === 2)
                            bg-warning text-dark
                        @else
                            bg-secondary text-white justify-content-center
                        @endif">
                        <h5 class="mb-0">{{ $group->name }}</h5>
                        @if ($groupId !== 3)
                            <small>ID: {{ $group->id }}</small>
                        @endif
                    </div>

                    {{-- Corpo do card --}}
                    @if ($groupId !== 3)
                        <div class="card-body">
                            <p><strong>Descrição:</strong> {{ $group->description ?? '—' }}</p>
                        </div>
                    @endif

                    {{-- Rodapé com ações (apenas para admin) --}}
                    @if ($groupId === 1)
                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('user-groups.edit', $group->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('user-groups.destroy', $group->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este grupo?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </div>
                    @endif

                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center alert alert-info">
                    @if ($groupId === 1)
                        Nenhum grupo de usuário encontrado.
                    @elseif ($groupId === 2)
                        Nenhum grupo de usuário disponível.
                    @else
                        Nenhum grupo visível para seu perfil.
                    @endif
                </div>
            </div>
        @endforelse
    </div>

    {{-- Paginação --}}
    @if ($userGroups->hasPages())
        <div class="mt-4 d-flex justify-content-center">
            {{ $userGroups->links() }}
        </div>
    @endif
</div>
@endsection
