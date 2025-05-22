@extends('layouts.app')

@section('title', 'Lista de Status de Tickets')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Lista de Status de Tickets</h1>

    {{-- Mensagem de sucesso --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Botão de criar novo status --}}
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('ticket-statuses.create') }}" class="btn btn-primary">
            Criar Novo Status
        </a>
    </div>

    {{-- Tabela de status --}}
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-light">
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
                            {{-- Botão Editar --}}
                            <a href="{{ route('ticket-statuses.edit', $status->id) }}" class="btn btn-warning btn-sm">
                                Editar
                            </a>

                            {{-- Botão Excluir --}}
                            <form action="{{ route('ticket-statuses.destroy', $status->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Deseja realmente excluir este status?');">
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
</div>
@endsection
