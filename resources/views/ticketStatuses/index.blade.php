@extends('layouts.app')

@section('title', 'Lista de Status de Tickets')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Lista de Status de Tickets</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('ticket-statuses.create') }}" class="mb-4 btn btn-primary">Criar Novo Status</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ticketStatuses as $status)
                <tr>
                    <td>{{ $status->id }}</td>
                    <td>{{ $status->name }}</td>
                    <td>
                        <a href="{{ route('ticket-statuses.edit', $status->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('ticket-statuses.destroy', $status->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Deseja realmente excluir este status?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Nenhum status encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
