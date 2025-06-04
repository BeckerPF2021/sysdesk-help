@extends('layouts.app')

@section('title', 'Relatório de Chamados')

@section('content')
<div class="container">
    <h2>Relatório de Chamados</h2>

    <form method="GET" class="mb-4 row">
        <div class="col-md-3">
            <label>Status:</label>
            <select name="status" class="form-control">
                <option value="">Todos</option>
                @foreach(App\Models\TicketStatus::all() as $status)
                    <option value="{{ $status->id }}" {{ request('status') == $status->id ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label>Responsável:</label>
            <select name="responsible" class="form-control">
                <option value="">Todos</option>
                @foreach(App\Models\User::all() as $user)
                    <option value="{{ $user->id }}" {{ request('responsible') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <label>De:</label>
            <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
        </div>

        <div class="col-md-2">
            <label>Até:</label>
            <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
        </div>

        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
        </div>
    </form>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Título</th>
                <th>Status</th>
                <th>Responsável</th>
                <th>Data de Abertura</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>{{ $ticket->title }}</td>
                    <td>{{ $ticket->status->name ?? '-' }}</td>
                    <td>{{ $ticket->responsible->name ?? '-' }}</td>
                    <td>{{ $ticket->created_at->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Nenhum chamado encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
