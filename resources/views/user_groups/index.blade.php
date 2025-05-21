@extends('layouts.app')

@section('title', 'Grupos de Usuários')

@section('content')
    <div class="mt-4 container-fluid">
        <h1 class="mb-4">Grupos de Usuários</h1>

        <!-- Mensagem de sucesso -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Erros de validação -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Botão para criar novo grupo -->
        <div class="mb-4">
            <a href="{{ route('user-groups.create') }}" class="btn btn-primary">Adicionar Novo Grupo</a>
        </div>

        <!-- Cards de grupos -->
        <div class="row">
            @forelse ($userGroups as $group)
                <div class="mb-4 col-md-6 col-lg-4">
                    <div class="shadow-sm card h-100">
                        <div class="text-white card-header bg-success d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">{{ $group->name }}</h5>
                            <small>ID: {{ $group->id }}</small>
                        </div>
                        <div class="card-body">
                            <p><strong>Descrição:</strong> {{ $group->description ?? '—' }}</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('user-groups.edit', $group->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('user-groups.destroy', $group->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este grupo?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center alert alert-info">
                        Nenhum grupo de usuário encontrado.
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Paginação -->
        <div class="d-flex justify-content-center">
            {{ $userGroups->links() }}
        </div>
    </div>
@endsection
