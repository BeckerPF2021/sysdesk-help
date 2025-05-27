@extends('layouts.app')

@section('title', 'Lista de Status de Tickets')

@section('content')
<div class="container-fluid px-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Status de Tickets</h5>
                    <a href="{{ route('ticket-statuses.create') }}" class="btn btn-light btn-sm">
                        + Novo Status
                    </a>
                </div>

                <div class="card-body">

                    {{-- Mensagem de sucesso --}}
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Tabela --}}
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 80px;">ID</th>
                                    <th>Nome</th>
                                    <th style="width: 150px;">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($ticketStatuses as $status)
                                    <tr>
                                        <td>{{ $status->id }}</td>
                                        <td>{{ $status->name }}</td>
                                        <td>
                                            <a href="{{ route('ticket-statuses.edit', $status->id) }}" class="btn btn-sm btn-warning">
                                                Editar
                                            </a>
                                            <form action="{{ route('ticket-statuses.destroy', $status->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Deseja realmente excluir este status?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">Nenhum status encontrado.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
