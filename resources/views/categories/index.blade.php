@extends('layouts.app')

@section('title', 'Lista de Categorias')

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
                                <i class="fas fa-folder-open me-3"></i>Categorias de Tickets
                            </h1>
                            <p class="mb-0 opacity-75 lead">Gerenciamento de categorias do sistema SYSDESK</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('categories.create') }}" class="shadow-sm btn btn-light btn-lg">
                                <i class="fas fa-plus me-2"></i>Nova Categoria
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if (session('success'))
        <div class="mb-4 row">
            <div class="col-12">
                <div class="border-0 shadow-sm alert alert-success alert-dismissible fade show" role="alert">
                    <div class="d-flex align-items-center">
                        <div class="p-2 bg-opacity-25 bg-success rounded-circle me-3">
                            <i class="fas fa-check-circle text-success"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1 alert-heading">Sucesso!</h6>
                            <p class="mb-0">{{ session('success') }}</p>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Lista de Categorias -->
    <div class="row">
        <div class="col-12">
            <div class="border-0 shadow-sm card">
                <!-- Card Header -->
                <div class="py-4 bg-white card-header border-bottom-0">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h4 class="mb-0 card-title text-dark fw-bold">
                                <i class="fas fa-list text-primary me-2"></i>
                                Lista de Categorias
                            </h4>
                        </div>
                        <div class="col-md-6 text-end">
                            <div class="d-flex align-items-center justify-content-end">
                                <div class="px-3 py-2 bg-light rounded-pill">
                                    <i class="fas fa-folder-open me-2"></i>
                                    <span class="fw-semibold">{{ $categories->count() }}</span>
                                    <small class="text-muted ms-1">categoria(s)</small>
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
                                    <th class="py-3 text-center fw-semibold">
                                        <i class="fas fa-hashtag text-muted me-1"></i>ID
                                    </th>
                                    <th class="py-3 fw-semibold">
                                        <i class="fas fa-tag text-muted me-1"></i>Nome da Categoria
                                    </th>
                                    <th class="py-3 text-center fw-semibold">
                                        <i class="fas fa-cogs text-muted me-1"></i>Ações
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr class="border-bottom">
                                        <td class="py-3 text-center">
                                            <span class="badge bg-light text-dark fw-bold">#{{ $category->id }}</span>
                                        </td>
                                        <td class="py-3">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    @php
                                                        $categoryColors = [
                                                            'técnico' => 'info',
                                                            'suporte' => 'primary',
                                                            'vendas' => 'success',
                                                            'financeiro' => 'warning',
                                                            'urgente' => 'danger'
                                                        ];
                                                        $colorClass = 'primary';
                                                        foreach($categoryColors as $key => $color) {
                                                            if(stripos($category->name, $key) !== false) {
                                                                $colorClass = $color;
                                                                break;
                                                            }
                                                        }
                                                    @endphp
                                                    <div class="bg-{{ $colorClass }} bg-opacity-10 rounded-circle p-2">
                                                        <i class="fas fa-folder text-{{ $colorClass }}"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="fw-semibold">{{ $category->name }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3 text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('categories.edit', $category->id) }}"
                                                   class="btn btn-sm btn-outline-warning"
                                                   title="Editar categoria">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button"
                                                        class="btn btn-sm btn-outline-danger"
                                                        title="Excluir categoria"
                                                        onclick="confirmDelete({{ $category->id }}, '{{ $category->name }}')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="py-5 text-center">
                                            <div class="text-muted">
                                                <i class="mb-3 opacity-50 fas fa-folder-open fa-3x"></i>
                                                <h5>Nenhuma categoria encontrada</h5>
                                                <p class="mb-0">Não há categorias cadastradas no sistema.</p>
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
    @if (method_exists($categories, 'links'))
        <div class="mt-4 row">
            <div class="col-12 d-flex justify-content-center">
                <div class="border-0 shadow-sm card">
                    <div class="py-3 card-body">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Info Section -->
    <div class="mt-4 row">
        <div class="col-12">
            <div class="border-0 card bg-light">
                <div class="py-4 card-body">
                    <div class="row align-items-center">
                        <div class="text-center col-md-2">
                            <i class="fas fa-info-circle fa-3x text-primary"></i>
                        </div>
                        <div class="col-md-8">
                            <h6 class="mb-2">Sobre o Sistema de Categorias</h6>
                            <p class="mb-0 text-muted small">
                                O sistema de categorias permite organizar tickets por tipo de solicitação ou departamento.
                                Defina categorias claras para facilitar a classificação e direcionamento dos atendimentos.
                            </p>
                        </div>
                        <div class="text-center col-md-2">
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
        <div class="border-0 shadow modal-content">
            <div class="text-white border-0 modal-header bg-danger">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirmar Exclusão
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="py-4 modal-body">
                <div class="text-center">
                    <i class="mb-3 fas fa-folder fa-3x text-danger"></i>
                    <h6>Tem certeza que deseja excluir esta categoria?</h6>
                    <p class="mb-0 text-muted">
                        Categoria: <strong id="categoryName"></strong><br>
                        <small>Esta ação não poderá ser desfeita.</small>
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

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<script>
function confirmDelete(categoryId, categoryName) {
    document.getElementById('categoryName').textContent = categoryName;
    document.getElementById('deleteForm').action = `/categories/${categoryId}`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
@endsection
