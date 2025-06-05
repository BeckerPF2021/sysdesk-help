@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Histórico de Tickets</h1>

    <a href="{{ route('ticket-histories.create') }}" class="mb-3 btn btn-primary">Novo Histórico</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Data/Hora</th>
                <th>Ação</th>
                <th>Ticket</th>
                <th>Usuário</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ticketHistories as $history)
                <tr>
                    <td>{{ $history->id }}</td>
                    <td>{{ $history->date_time }}</td>
                    <td>{{ $history->action }}</td>
                    <td>{{ $history->ticket->id ?? 'N/A' }}</td>
                    <td>{{ $history->user->name ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('ticket-histories.show', $history->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('ticket-histories.edit', $history->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('ticket-histories.destroy', $history->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Confirmar exclusão?')" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $ticketHistories->links() }}
</div>
@endsection
