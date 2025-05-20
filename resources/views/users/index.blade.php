@extends('layouts.app')

@section('title', 'Usuários Registrados')

@section('content')
    <div class="mt-4 container-fluid">
        <h1 class="mb-4">Usuários Registrados</h1>

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

        <!-- Botão para criar novo usuário -->
        <div class="mb-4">
            <a href="{{ route('users.create') }}" class="btn btn-primary">Criar Novo Usuário</a>
        </div>

        <!-- Cards de usuários -->
        <div class="row">
            @forelse ($users as $user)
                <div class="mb-4 col-md-6 col-lg-4">
                    <div class="shadow-sm card h-100">
                        <div class="text-white card-header bg-primary d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">{{ $user->name }}</h5>
                            <small>ID: {{ $user->id }}</small>
                        </div>
                        <div class="card-body">
                            <p><strong>Email:</strong> {{ $user->email }}</p>
                            <p><strong>Grupo:</strong> {{ $user->userGroup->name ?? '—' }}</p>
                            <p><strong>Registrado em:</strong> {{ $user->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');">
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
                        Nenhum usuário encontrado.
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Paginação -->
        <div class="d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
@endsection
