@extends('layouts.app')

@section('title', 'Lista de Tickets')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Lista de Tickets</h1>

    <!-- Mensagem de sucesso -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Exibição de erros -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <a href="{{ route('tickets.create') }}" class="mb-4 btn btn-primary">Criar Novo Ticket</a>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descrição</th>
                <th>Aberto por</th> {{-- Novo campo --}}
                <th>Status</th>
                <th>Prioridade</th>
                <th>Departamento</th>
                <th>Responsável</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->id }}</td>
                    <td>
                        <a href="{{ route('tickets.show', $ticket->id) }}">
                            {{ $ticket->title }}
                        </a>
                    </td>
                    <td>{{ $ticket->description }}</td>
                                        <td>{{ $ticket->user ? $ticket->user->name : '-' }}</td> {{-- Criador --}}
                    <td>{{ $ticket->ticketStatus->name }}</td>
                    <td>{{ $ticket->ticketPriority->name }}</td>
                    <td>{{ $ticket->department->name }}</td>
                    <td>{{ $ticket->responsibleUser ? $ticket->responsibleUser->name : '-' }}</td>
                    <td>
                        <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza que deseja excluir este ticket?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Nenhum ticket encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
