@extends('layouts.app')

@section('title', 'Grupos de Usuários')

@section('content')
@php
    $groupId = Auth::user()->user_group_id;
    $groupColors = [1 => 'primary', 2 => 'warning', 3 => 'success'];
    $groupIcons = [1 => 'crown', 2 => 'headset', 3 => 'user'];
@endphp

<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-gradient-info border-0 shadow-lg">
                <div class="card-body text-white py-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="display-6 fw-bold mb-2">
                                <i class="fas fa-users-cog me-3"></i>Grupos de Usuários
                            </h1>
                            <p class="lead mb-0 opacity-75">Gerenciamento de grupos e permissões do sistema</p>
                        </div>
                        <div class="col-md-4 text-end">
                            @if ($groupId === 1)
                                <a href="{{ route('user-groups.create') }}" class="btn btn-light btn-lg shadow-sm">
                                    <i class="fas fa-plus me-2"></i>Novo Grupo
                                </a>
                            @endif
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

    @if ($errors->any())
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <div class="d-flex align-items-start">
                        <div class="bg-danger bg-opacity-25 rounded-circle p-2 me-3">
                            <i class="fas fa-exclamation-triangle text-danger"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="alert-heading mb-2">Atenção!</h6>
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

    {{-- Tabela de grupos --}}
    @if ($userGroups->count())
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <!-- Card Header -->
                    <div class="card-header bg-white border-bottom-0 py-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h4 class="card-title mb-0 text-dark fw-bold">
                                    <i class="fas fa-list text-info me-2"></i>
                                    Lista de Grupos
                                </h4>
                            </div>
                            <div class="col-md-6 text-end">
                                <div class="d-flex align-items-center justify-content-end">
                                    <div class="px-3 py-2 border rounded">
                                        <i class="fas fa-users-cog me-2"></i>
                                        <span class="fw-semibold">{{ $userGroups->total() }}</span>
                                        <small class="text-muted ms-1">grupo(s)</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body p-0">
                        @if ($groupId === 3)
                            {{-- Layout em cards para usuários normais --}}
                            <div class="row g-4 p-4">
                                @foreach ($userGroups as $group)
                                    <div class="col-md-4">
                                        <div class="card border-0 shadow-sm h-100">
                                            <div class="card-body text-center p-4">
                                                @php
                                                    $color = $groupColors[$group->id] ?? 'secondary';
                                                    $icon = $groupIcons[$group->id] ?? 'users';
                                                @endphp
                                                <div class="bg-{{ $color }} bg-opacity-10 rounded-circle p-4 d-inline-block mb-3">
                                                    <i class="fas fa-{{ $icon }} fa-3x text-{{ $color }}"></i>
                                                </div>
                                                <h5 class="card-title fw-bold text-{{ $color }} mb-2">{{ $group->name }}</h5>
                                                @if ($group->description)
                                                    <p class="card-text text-muted">{{ $group->description }}</p>
                                                @endif
                                                <span class="badge bg-{{ $color }} bg-opacity-25 text-{{ $color }} px-3 py-2">
                                                    ID: {{ $group->id }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            {{-- Layout em tabela para admin e agentes --}}
                            <div class="table-responsive">
                                <table class="table table-hover mb-0 align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="py-3 fw-semibold">
                                                <i class="fas fa-tag text-muted me-1"></i>Nome do Grupo
                                            </th>
                                            <th class="py-3 fw-semibold">
                                                <i class="fas fa-info-circle text-muted me-1"></i>Descrição
                                            </th>
                                            <th class="text-center py-3 fw-semibold">
                                                <i class="fas fa-hashtag text-muted me-1"></i>ID
                                            </th>
                                            @if ($groupId === 1)
                                                <th class="text-center py-3 fw-semibold">
                                                    <i class="fas fa-cogs text-muted me-1"></i>Ações
                                                </th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($userGroups as $group)
                                            <tr class="border-bottom">
                                                <td class="py-3">
                                                    <div class="d-flex align-items-center">
                                                        @php
                                                            $color = $groupColors[$group->id] ?? 'secondary';
                                                        @endphp
                                                        <div>
                                                            <div class="fw-semibold text-{{ $color }}">{{ $group->name }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="py-3">
                                                    @if ($group->description)
                                                        <span class="text-muted">{{ $group->description }}</span>
                                                    @else
                                                        <span class="text-muted fst-italic">Sem descrição</span>
                                                    @endif
                                                </td>
                                                <td class="text-center py-3">
                                                    <span class="badge bg-light text-dark fw-bold">#{{ $group->id }}</span>
                                                </td>
                                                @if ($groupId === 1)
                                                    <td class="text-center py-3">
                                                        <div class="btn-group" role="group">
                                                            <a href="{{ route('user-groups.edit', $group->id) }}" 
                                                               class="btn btn-sm btn-outline-warning" 
                                                               title="Editar grupo">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <button type="button" 
                                                                    class="btn btn-sm btn-outline-danger" 
                                                                    title="Excluir grupo"
                                                                    onclick="confirmDelete({{ $group->id }}, '{{ $group->name }}')">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Paginação --}}
        @if ($userGroups->hasPages())
            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-center">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body py-3">
                            {{ $userGroups->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @else
        {{-- Estado vazio --}}
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-users-slash fa-4x text-muted mb-4 opacity-50"></i>
                        <h4 class="text-muted mb-3">Nenhum Grupo Encontrado</h4>
                        @if ($groupId === 1)
                            <p class="text-muted mb-4">Não há grupos de usuários cadastrados no sistema.</p>
                            <a href="{{ route('user-groups.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Criar Primeiro Grupo
                            </a>
                        @elseif ($groupId === 2)
                            <p class="text-muted mb-0">Nenhum grupo disponível para visualização.</p>
                        @else
                            <p class="text-muted mb-0">Nenhum grupo visível para seu perfil.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Informações Adicionais -->
    @if ($userGroups->count() && $groupId !== 3)
        <div class="row mt-4">
            <div class="col-12">
                <div class="card bg-light border-0">
                    <div class="card-body py-4">
                        <div class="row align-items-center">
                            <div class="col-md-2 text-center">
                                <i class="fas fa-info-circle fa-3x text-info"></i>
                            </div>
                            <div class="col-md-8">
                                <h6 class="mb-2">Sobre os Grupos de Usuários</h6>
                                <p class="text-muted small mb-0">
                                    Os grupos definem as permissões e funcionalidades que cada usuário pode acessar no sistema SYSDESK. 
                                    Administradores podem gerenciar todos os aspectos, Agentes focam no atendimento, e Usuários criam e acompanham tickets.
                                </p>
                            </div>
                            <div class="col-md-2 text-center">
                                <div class="row g-2">
                                    @foreach ([1 => 'primary', 2 => 'warning', 3 => 'success'] as $id => $color)
                                        <div class="col-4">
                                            <div class="bg-{{ $color }} rounded-circle p-2">
                                                <i class="fas fa-{{ $groupIcons[$id] }} text-white"></i>
                                            </div>
                                        </div>
                                    @endforeach
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
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-danger text-white border-0">
                <h5 class="modal-title" id="deleteModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirmar Exclusão
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body py-4">
                <div class="text-center">
                    <i class="fas fa-users-slash fa-3x text-danger mb-3"></i>
                    <h6>Tem certeza que deseja excluir este grupo?</h6>
                    <p class="text-muted mb-0">
                        Grupo: <strong id="groupName"></strong><br>
                        <small class="text-warning">
                            <i class="fas fa-exclamation-triangle me-1"></i>
                            Atenção: Esta ação pode afetar usuários vinculados a este grupo.
                        </small>
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
.bg-gradient-info {
    background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
}

.table-hover tbody tr:hover {
    background-color: rgba(23, 162, 184, 0.05);
    transform: translateY(-1px);
    transition: all 0.2s ease;
}

.card {
    transition: all 0.3s ease;
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
</style>

<script>
function confirmDelete(groupId, groupName) {
    document.getElementById('groupName').textContent = groupName;
    document.getElementById('deleteForm').action = `/user-groups/${groupId}`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
@endsection