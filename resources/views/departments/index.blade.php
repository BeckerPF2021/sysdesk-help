@extends('layouts.app')

@section('title', 'Departamentos')

@section('content')
<div class="py-4 container-fluid">
    <!-- Header Section -->
    <div class="mb-4 row">
        <div class="col-12">
            <div class="border-0 shadow-lg card bg-gradient-primary">
                <div class="py-4 text-white card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="mb-2 display-6 fw-bold">
                                <i class="fas fa-building me-3"></i>Departamentos
                            </h1>
                            <p class="mb-0 opacity-75 lead">Gerenciamento de departamentos organizacionais</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('departments.create') }}" class="shadow-sm btn btn-light btn-lg">
                                <i class="fas fa-plus me-2"></i>Novo Departamento
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if ($errors->any())
        <div class="mb-4 row">
            <div class="col-12">
                <div class="border-0 shadow-sm alert alert-danger alert-dismissible fade show" role="alert">
                    <div class="d-flex align-items-start">
                        <div class="p-2 bg-opacity-25 bg-danger rounded-circle me-3">
                            <i class="fas fa-exclamation-triangle text-danger"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-2 alert-heading">Atenção!</h6>
                            <p class="mb-2"><strong>Por favor, corrija os seguintes erros:</strong></p>
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Tabela de departamentos --}}
    @if ($departments->count())
        <div class="row">
            <div class="col-12">
                <div class="border-0 shadow-sm card">
                    <!-- Card Header -->
                    <div class="py-4 bg-white card-header border-bottom-0">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h4 class="mb-0 card-title text-dark fw-bold">
                                    <i class="fas fa-list text-primary me-2"></i>
                                    Lista de Departamentos
                                </h4>
                            </div>
                            <div class="col-md-6 text-end">
                                <div class="d-flex align-items-center justify-content-end">
                                    <div class="px-3 py-2 rounded-pill">
                                        <i class="fas fa-building me-2"></i>
                                        <span class="fw-semibold">{{ $departments->count() }}</span>
                                        <small class="text-muted ms-1">departamento(s)</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-0 card-body">
                        <div class="table-responsive">
                            <table class="table mb-0 align-middle table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th class="py-3 fw-semibold" style="width: 100px;">
                                            <i class="fas fa-hashtag text-muted me-1"></i>ID
                                        </th>
                                        <th class="py-3 fw-semibold">
                                            <i class="fas fa-tag text-muted me-1"></i>Nome do Departamento
                                        </th>
                                        <th class="py-3 text-center fw-semibold" style="width: 140px;">
                                            <i class="fas fa-cogs text-muted me-1"></i>Ações
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($departments as $department)
                                        <tr class="border-bottom">
                                            <td class="py-3">
                                                <span class="px-2 py-1 badge bg-light text-dark fw-bold">
                                                    #{{ str_pad($department->id, 3, '0', STR_PAD_LEFT) }}
                                                </span>
                                            </td>
                                            <td class="py-3">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <div class="fw-semibold">{{ $department->name }}</div>
                                                </div>
                                            </div>
                                            </td>
                                            <td class="py-3 text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('departments.edit', $department->id) }}"
                                                       class="btn btn-sm btn-outline-warning"
                                                       title="Editar departamento"
                                                       data-bs-toggle="tooltip">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button"
                                                            class="btn btn-sm btn-outline-danger"
                                                            title="Excluir departamento"
                                                            data-bs-toggle="tooltip"
                                                            onclick="confirmDelete({{ $department->id }}, '{{ $department->name }}')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Paginação --}}
        @if (method_exists($departments, 'links') && $departments->hasPages())
            <div class="mt-4 row">
                <div class="col-12 d-flex justify-content-center">
                    <div class="border-0 shadow-sm card">
                        <div class="py-3 card-body">
                            {{ $departments->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @else
        {{-- Estado vazio --}}
        <div class="row">
            <div class="col-12">
                <div class="border-0 shadow-sm card">
                    <div class="py-5 text-center card-body">
                        <i class="mb-4 opacity-50 fas fa-building-slash fa-4x text-muted"></i>
                        <h4 class="mb-3 text-muted">Nenhum Departamento Encontrado</h4>
                        <p class="mb-4 text-muted">Não há departamentos cadastrados no sistema.</p>
                        <a href="{{ route('departments.create') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-plus me-2"></i>Criar Primeiro Departamento
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Informações Adicionais -->
    @if ($departments->count())
        <div class="mt-4 row">
            <div class="col-12">
                <div class="border-0 card bg-light">
                    <div class="py-4 card-body">
                        <div class="row align-items-center">
                            <div class="text-center col-md-2">
                                <i class="fas fa-info-circle fa-3x text-primary"></i>
                            </div>
                            <div class="col-md-8">
                                <h6 class="mb-2">Sobre os Departamentos</h6>
                                <p class="mb-0 text-muted small">
                                    Os departamentos ajudam a organizar a estrutura da sua empresa no sistema SYSDESK.
                                    Eles facilitam a categorização de usuários, tickets e processos, tornando o gerenciamento mais eficiente e organizado.
                                </p>
                            </div>
                            <div class="text-center col-md-2">
                                <div class="p-3 bg-primary bg-opacity-10 rounded-circle d-inline-block">
                                    <i class="fas fa-building fa-2x text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="border-0 shadow modal-content">
            <div class="text-white border-0 modal-header bg-danger">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirmar Exclusão
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="py-4 modal-body">
                <div class="text-center">
                    <i class="mb-3 fas fa-building-slash fa-3x text-danger"></i>
                    <h6>Tem certeza que deseja excluir este departamento?</h6>
                    <p class="mb-0 text-muted">
                        Departamento: <strong id="departmentName"></strong><br>
                        <small class="text-warning">
                            <i class="fas fa-exclamation-triangle me-1"></i>
                            Atenção: Esta ação pode afetar usuários vinculados a este departamento.
                        </small>
                    </p>
                </div>
            </div>
            <div class="border-0 modal-footer">
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

.card {
    transition: all 0.3s ease;
    border-radius: 12px;
    overflow: hidden;
}

.card:hover {
    transform: translateY(-2px);
}

.border-bottom {
    border-bottom: 1px solid rgba(0,0,0,0.1) !important;
}

.btn-group .btn {
    margin: 0 2px;
}

.rounded-circle {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.badge {
    border-radius: 8px;
    font-size: 0.8em;
}

/* Animações suaves */
.btn, .alert {
    transition: all 0.2s ease-in-out;
}

.btn:hover {
    transform: translateY(-1px);
}

/* Responsividade */
@media (max-width: 768px) {
    .container-fluid {
        padding-left: 1rem;
        padding-right: 1rem;
    }

    .card-body .row {
        flex-direction: column;
        gap: 1rem;
    }

    .btn-group {
        flex-direction: column;
        width: 100%;
    }

    .btn-group .btn {
        margin: 1px 0;
        border-radius: 4px !important;
    }

    .display-6 {
        font-size: 1.5rem;
    }

    .btn-lg {
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }
}

/* Tooltips customizados */
.tooltip-inner {
    background-color: #212529;
    border-radius: 6px;
}

.tooltip.bs-tooltip-top .tooltip-arrow::before {
    border-top-color: #212529;
}
</style>

<script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<script>

// Função para confirmar exclusão
function confirmDelete(departmentId, departmentName) {
    document.getElementById('departmentName').textContent = departmentName;
    document.getElementById('deleteForm').action = `/departments/${departmentId}`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}

// Inicializar tooltips
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
@endsection
