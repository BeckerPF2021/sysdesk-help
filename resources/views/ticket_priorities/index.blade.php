@extends('layouts.app')

@section('title', 'Lista de Prioridades')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Lista de Prioridades</h1>

    <!-- Exibição de mensagens de sucesso -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('ticket-priorities.create') }}" class="mb-4 btn btn-primary">Criar Nova Prioridade</a>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ticketPriorities as $priority)
                <tr>
                    <td>{{ $priority->id }}</td>
                    <td>{{ $priority->name }}</td>
                    <td>
                        <a href="{{ route('ticket-priorities.edit', $priority->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('ticket-priorities.destroy', $priority->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir esta prioridade?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Nenhuma prioridade encontrada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
