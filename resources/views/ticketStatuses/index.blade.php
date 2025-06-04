@extends('layouts.app')

@section('title', 'Lista de Status de Tickets')

@section('content')
<div class="container mt-5">
    <div class="flex-wrap mb-2 d-flex justify-content-between align-items-center">
        <h1 class="mb-3 text-primary fw-bold d-flex align-items-center">
            <i class="fas fa-tags me-2"></i> Status de Tickets
        </h1>
        <a href="{{ route('ticket-statuses.create') }}" class="mb-2 shadow-sm btn btn-primary fw-semibold">
            <i class="fas fa-plus me-1"></i> Novo Status
        </a>
    </div>

    {{-- Total abaixo do botão, alinhado à direita --}}
    <div class="mb-4 text-end" style="font-size: 1rem; color: #000;">
        Total: {{ $ticketStatuses->count() }}
    </div>

    {{-- Mensagem de sucesso --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    @endif

    {{-- Tabela --}}
    <section class="mb-5">
        <div class="rounded shadow table-responsive">
            <table class="table mb-0 align-middle table-hover table-striped text-nowrap" style="font-size: 0.93rem;">
                <thead class="table-light">
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Nome</th>
                        <th class="text-end pe-2" style="width: 150px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ticketStatuses as $status)
                        <tr>
                            <td class="fw-semibold">{{ $status->id }}</td>
                            <td>{{ $status->name }}</td>
                            <td class="text-end pe-2">
                                <div class="d-inline-flex">
                                    <a href="{{ route('ticket-statuses.edit', $status->id) }}" class="btn btn-sm btn-warning me-2" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('ticket-statuses.destroy', $status->id) }}" method="POST" onsubmit="return confirm('Deseja realmente excluir este status?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Excluir">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-3 text-center text-muted fst-italic">Nenhum status encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    {{-- Paginação --}}
    @if (method_exists($ticketStatuses, 'links'))
        <div class="mt-4 d-flex justify-content-center">
            {{ $ticketStatuses->links() }}
        </div>
    @endif
</div>
@endsection
