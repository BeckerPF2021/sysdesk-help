@extends('layouts.app')

@section('title', 'Lista de Prioridades')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-gradient-primary border-0 shadow-lg">
                <div class="card-body text-white py-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="display-6 fw-bold mb-2">
                                <i class="fas fa-exclamation-circle me-3"></i>Prioridades de Tickets
                            </h1>
                            <p class="lead mb-0 opacity-75">Gerenciamento de prioridades do sistema SYSDESK</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('ticket-priorities.create') }}" class="btn btn-light btn-lg shadow-sm">
                                <i class="fas fa-plus me-2"></i>Nova Prioridade
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if (session('success'))
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <div class="d-flex align-items-center">
                        <div class="bg-success bg-opacity-25 rounded-circle p-2 me-3">
                            <i class="fas fa-check-circle text-success"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="alert-heading mb-1">Sucesso!</h6>
                            <p class="mb-0">{{ session('success') }}</p>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Lista de Prioridades -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <!-- Card Header -->
                <div class="card-header bg-white border-bottom-0 py-4">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h4 class="card-title mb-0 text-dark fw-bold">
                                <i class="fas fa-list text-primary me-2"></i>
                                Lista de Prioridades
                            </h4>
                        </div>
                        <div class="col-md-6 text-end">
                            <div class="d-flex align-items-center justify-content-end">
                                <div class="bg-light rounded-pill px-3 py-2">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    <span class="fw-semibold">{{ $ticketPriorities->count() }}</span>
                                    <small class="text-muted ms-1">prioridade(s)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center py-3 fw-semibold">
                                        <i class="fas fa-hashtag text-muted me-1"></i>ID
                                    </th>
                                    <th class="py-3 fw-semibold">
                                        <i class="fas fa-flag text-muted me-1"></i>Nome da Prioridade
                                    </th>
                                    <th class="text-center py-3 fw-semibold">
                                        <i class="fas fa-cogs text-muted me-1"></i>Ações
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($ticketPriorities as $priority)
                                    <tr class="border-bottom">
                                        <td class="text-center py-3">
                                            <span class="badge bg-light text-dark fw-bold">#{{ $priority->id }}</span>
                                        </td>
                                        <td class="py-3">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    @php
                                                        $priorityColors = [
                                                            'baixa' => 'success',
                                                            'media' => 'warning', 
                                                            'alta' => 'danger',
                                                            'urgente' => 'dark'
                                                        ];
                                                        $colorClass = 'primary';
                                                        foreach($priorityColors as $key => $color) {
                                                            if(stripos($priority->name, $key) !== false) {
                                                                $colorClass = $color;
                                                                break;
                                                            }
                                                        }
                                                    @endphp
                                                    <div class="bg-{{ $colorClass }} bg-opacity-10 rounded-circle p-2">
                                                        <i class="fas fa-flag text-{{ $colorClass }}"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="fw-semibold">{{ $priority->name }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center py-3">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('ticket-priorities.edit', $priority->id) }}" 
                                                   class="btn btn-sm btn-outline-warning" 
                                                   title="Editar prioridade">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" 
                                                        class="btn btn-sm btn-outline-danger" 
                                                        title="Excluir prioridade"
                                                        onclick="confirmDelete({{ $priority->id }}, '{{ $priority->name }}')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="fas fa-exclamation-circle fa-3x mb-3 opacity-50"></i>
                                                <h5>Nenhuma prioridade encontrada</h5>
                                                <p class="mb-0">Não há prioridades cadastradas no sistema.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Paginação -->
    @if (method_exists($ticketPriorities, 'links'))
        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-center">
                <div class="card border-0 shadow-sm">
                    <div class="card-body py-3">
                        {{ $ticketPriorities->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Info Section -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card bg-light border-0">
                <div class="card-body py-4">
                    <div class="row align-items-center">
                        <div class="col-md-2 text-center">
                            <i class="fas fa-info-circle fa-3x text-primary"></i>
                        </div>
                        <div class="col-md-8">
                            <h6 class="mb-2">Sobre o Sistema de Prioridades</h6>
                            <p class="text-muted small mb-0">
                                O sistema de prioridades permite classificar tickets de acordo com sua urgência e importância.
                                Defina prioridades para organizar o atendimento e garantir que questões críticas sejam tratadas primeiro.
                            </p>
                        </div>
                        <div class="col-md-2 text-center">
                            <div class="row g-2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white border-0">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirmar Exclusão
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body py-4">
                <div class="text-center">
                    <i class="fas fa-flag fa-3x text-danger mb-3"></i>
                    <h6>Tem certeza que deseja excluir esta prioridade?</h6>
                    <p class="text-muted mb-0">
                        Prioridade: <strong id="priorityName"></strong><br>
                        <small>Esta ação não poderá ser desfeita.</small>
                    </p>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Cancelar
                </button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash-alt me-1"></i>Excluir
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
}

.table-hover tbody tr:hover {
    background-color: rgba(0, 123, 255, 0.05);
    transform: translateY(-1px);
    transition: all 0.2s ease;
}

.btn-group .btn {
    margin: 0 2px;
}

.card {
    transition: all 0.3s ease;
}

.border-bottom {
    border-bottom: 1px solid rgba(0,0,0,0.1) !important;
}
</style>

<script>
function confirmDelete(priorityId, priorityName) {
    document.getElementById('priorityName').textContent = priorityName;
    document.getElementById('deleteForm').action = `/ticket-priorities/${priorityId}`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
@endsection