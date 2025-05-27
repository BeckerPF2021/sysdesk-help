@extends('layouts.app')

@section('title', 'Usuários Registrados')

@section('content')
<div class="container my-5">
    <h1 class="mb-4 text-center">Usuários Registrados</h1>

    <!-- Mensagem de sucesso -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
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

    @php
        $groupId = Auth::user()->user_group_id;
    @endphp

    {{-- BLOCO 1 - ADMINISTRADOR --}}
    @if ($groupId === 1)
        <div class="mb-4 text-center">
            <a href="{{ route('users.create') }}" class="px-4 btn btn-primary">Criar Novo Usuário</a>
        </div>

        <div class="row">
            @forelse ($users as $user)
                <div class="mb-4 col-md-6 col-lg-4">
                    <div class="shadow-sm card h-100">
                        <div class="text-white card-header bg-primary d-flex justify-content-between align-items-center">
                            <strong>{{ $user->name }}</strong>
                            <span>ID: {{ $user->id }}</span>
                        </div>
                        <div class="card-body">
                            <p><strong>Email:</strong> {{ $user->email }}</p>
                            <p><strong>Grupo:</strong> {{ $user->userGroup->name ?? '—' }}</p>
                            <p><strong>Registrado em:</strong> {{ $user->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            @if ($user->id !== Auth::id())
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center alert alert-info">Nenhum usuário encontrado.</div>
                </div>
            @endforelse
        </div>
    @endif

    {{-- BLOCO 2 - AGENTE --}}
    @if ($groupId === 2)
        <div class="row">
            @forelse ($users as $user)
                @if ($user->user_group_id !== 1)
                    <div class="mb-4 col-md-6 col-lg-4">
                        <div class="shadow-sm card h-100">
                            <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                                <strong>{{ $user->name }}</strong>
                                <span>ID: {{ $user->id }}</span>
                            </div>
                            <div class="card-body">
                                <p><strong>Email:</strong> {{ $user->email }}</p>
                                <p><strong>Grupo:</strong> {{ $user->userGroup->name ?? '—' }}</p>
                                <p><strong>Registrado em:</strong> {{ $user->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div class="text-center card-footer">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-secondary">Ver/Editar</a>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                <div class="col-12">
                    <div class="text-center alert alert-info">Nenhum usuário disponível.</div>
                </div>
            @endforelse
        </div>
    @endif

    {{-- BLOCO 3 - USUÁRIO NORMAL --}}
    @if ($groupId === 3)
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="shadow-sm card h-100">
                    <div class="text-white card-header bg-success d-flex justify-content-between align-items-center">
                        <strong>{{ Auth::user()->name }}</strong>
                        <span>ID: {{ Auth::user()->id }}</span>
                    </div>
                    <div class="card-body">
                        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                        <p><strong>Grupo:</strong> {{ Auth::user()->userGroup->name ?? '—' }}</p>
                        <p><strong>Registrado em:</strong> {{ Auth::user()->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="text-center card-footer">
                        <a href="{{ route('users.edit', Auth::id()) }}" class="btn btn-sm btn-secondary">Editar Perfil</a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Paginação -->
    @if ($groupId === 1 || $groupId === 2)
        <div class="mt-4 d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    @endif
</div>
@endsection
