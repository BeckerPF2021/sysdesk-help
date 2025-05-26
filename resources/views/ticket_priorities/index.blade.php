@extends('layouts.app')

@section('title', 'Lista de Prioridades')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Lista de Prioridades</h1>

    {{-- Mensagem de sucesso --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('ticket-priorities.create') }}" class="btn btn-primary">
            Criar Nova Prioridade
        </a>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-bordered table-hover mb-0">
            <thead class="thead-light">
                <tr>
                    <th style="width: 10%;">ID</th>
                    <th>Nome</th>
                    <th style="width: 25%;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ticketPriorities as $priority)
                    <tr>
                        <td>{{ $priority->id }}</td>
                        <td>{{ $priority->name }}</td>
                        <td>
                            <a href="{{ route('ticket-priorities.edit', $priority->id) }}" class="btn btn-warning btn-sm mr-2">
                                Editar
                            </a>
                            <form action="{{ route('ticket-priorities.destroy', $priority->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir esta prioridade?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted">Nenhuma prioridade encontrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
