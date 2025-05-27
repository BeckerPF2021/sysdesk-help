@extends('layouts.app')

@section('title', 'Lista de Tickets por Status')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-primary fw-bold">Lista de Tickets</h1>

    {{-- Mensagem de sucesso --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    @endif

    {{-- Erros --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Por favor, corrija os erros:</strong>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    @endif

    {{-- Filtros de busca + botão + contagem --}}
    <div class="flex-wrap gap-2 mb-4 d-flex justify-content-between align-items-center">
        <form action="{{ route('tickets.index') }}" method="GET" class="d-flex flex-grow-1 me-3" role="search">
            <input
                type="search"
                name="search"
                value="{{ request('search', $search ?? '') }}"
                class="form-control"
                placeholder="Buscar tickets pelo título..."
                aria-label="Buscar tickets pelo título"
            />

            <select name="status_id" class="form-select ms-2" aria-label="Filtrar por status">
                <option value="">Todos os Status</option>
                @foreach ($ticketStatuses as $status)
                    <option value="{{ $status->id }}" @selected(request('status_id', $statusId ?? '') == $status->id)>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-primary ms-2">Filtrar</button>
        </form>

        <a href="{{ route('tickets.create') }}" class="btn btn-primary fw-semibold">
            <i class="fas fa-plus me-1"></i> Novo Ticket
        </a>

        <small class="text-muted fst-italic">{{ $tickets->total() }} ticket(s)</small>
    </div>

    @php
        $groupedTickets = $tickets->groupBy(fn($ticket) => $ticket->ticketStatus->name);
    @endphp

    @foreach ($groupedTickets as $status => $ticketsGroup)
        <section class="mb-5">
            <h3 class="pb-2 mb-3 border-bottom text-secondary fw-semibold">
                Status: <span class="text-primary">{{ $status }}</span> ({{ $ticketsGroup->count() }})
            </h3>

            <div class="rounded shadow table-responsive">
                <table class="table mb-0 align-middle table-striped table-hover" style="font-size: 0.95rem;">
                    <thead class="text-center table-light text-nowrap">
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Descrição</th>
                            <th>Aberto por</th>
                            <th>Prioridade</th>
                            <th>Departamento</th>
                            <th>Responsável</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ticketsGroup as $ticket)
                            <tr>
                                <td class="text-center fw-semibold">{{ $ticket->id }}</td>
                                <td>
                                    <a href="{{ route('tickets.show', $ticket->id) }}" class="text-primary fw-semibold text-decoration-none" title="{{ $ticket->title }}">
                                        {{ \Illuminate\Support\Str::limit($ticket->title, 40) }}
                                    </a>
                                </td>
                                <td>{{ \Illuminate\Support\Str::limit($ticket->description, 50) }}</td>
                                <td>{{ $ticket->user->name ?? '-' }}</td>
                                <td class="text-center">{{ $ticket->ticketPriority->name }}</td>
                                <td>{{ $ticket->department->name }}</td>
                                <td>{{ $ticket->responsibleUser->name ?? '-' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-sm btn-warning me-2" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirma exclusão?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Excluir">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    @endforeach

    @if(method_exists($tickets, 'links'))
        <div class="mt-4 d-flex justify-content-center">
            {{ $tickets->links() }}
        </div>
    @endif
</div>
@endsection
