@extends('layouts.app')

@section('title', 'Usuários Registrados')

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
                                <i class="fas fa-users me-3"></i>Usuários
                            </h1>
                            <p class="lead mb-0 opacity-75">Gerenciamento de usuários do sistema SYSDESK</p>
                        </div>
                        <div class="col-md-4 text-end">
                            @php $groupId = Auth::user()->user_group_id; @endphp
                            @if ($groupId === 1)
                                <a href="{{ route('users.create') }}" class="btn btn-light btn-lg shadow-sm">
                                    <i class="fas fa-user-plus me-2"></i>Novo Usuário
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

    {{-- Lista de Usuários para Admin e Agente --}}
    @if (in_array($groupId, [1, 2]))
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <!-- Card Header -->
                    <div class="card-header bg-white border-bottom-0 py-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h4 class="card-title mb-0 text-dark fw-bold">
                                    <i class="fas fa-list text-primary me-2"></i>
                                    Lista de Usuários
                                </h4>
                            </div>
                            <div class="col-md-6 text-end">
                                <div class="d-flex align-items-center justify-content-end">
                                    <div class="bg-light rounded-pill px-3 py-2">
                                        <i class="fas fa-users me-2"></i>
                                        <span class="fw-semibold">{{ $users->total() }}</span>
                                        <small class="text-muted ms-1">usuário(s)</small>
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
                                            <i class="fas fa-user text-muted me-1"></i>Nome
                                        </th>
                                        <th class="py-3 fw-semibold">
                                            <i class="fas fa-envelope text-muted me-1"></i>Email
                                        </th>
                                        <th class="py-3 fw-semibold">
                                            <i class="fas fa-shield-alt text-muted me-1"></i>Grupo
                                        </th>
                                        <th class="py-3 fw-semibold">
                                            <i class="fas fa-calendar text-muted me-1"></i>Registrado
                                        </th>
                                        <th class="text-center py-3 fw-semibold">
                                            <i class="fas fa-cogs text-muted me-1"></i>Ações
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        @if (!($groupId === 2 && $user->user_group_id === 1))
                                            <tr class="border-bottom">
                                                <td class="text-center py-3">
                                                    <span class="badge bg-light text-dark fw-bold">#{{ $user->id }}</span>
                                                </td>
                                                <td class="py-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="me-3"></div> <!-- Espaço vazio para manter alinhamento -->
                                                        <div>
                                                            <div class="fw-semibold">{{ $user->name }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="py-3">
                                                    <span class="text-muted">{{ $user->email }}</span>
                                                </td>
                                                <td class="py-3">
                                                    @php
                                                        $groupIcons = [1 => 'crown', 2 => 'headset', 3 => 'user'];
                                                        $icon = $groupIcons[$user->user_group_id] ?? 'question';
                                                    @endphp
                                                    <span class="px-3 py-2">
                                                        <i class="fas fa-{{ $icon }} me-1"></i>
                                                        {{ $user->userGroup->name ?? '—' }}
                                                    </span>
                                                </td>
                                                <td class="py-3">
                                                    <div class="text-muted">
                                                        <i class="fas fa-calendar-alt me-1"></i>
                                                        {{ $user->created_at->format('d/m/Y') }}
                                                        <br>
                                                        <small class="text-muted">
                                                            <i class="fas fa-clock me-1"></i>
                                                            {{ $user->created_at->format('H:i') }}
                                                        </small>
                                                    </div>
                                                </td>
                                                <td class="text-center py-3">
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('users.edit', $user->id) }}" 
                                                           class="btn btn-sm btn-outline-warning" 
                                                           title="Editar usuário">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        @if ($groupId === 1 && $user->id !== Auth::id())
                                                            <button type="button" 
                                                                    class="btn btn-sm btn-outline-danger" 
                                                                    title="Excluir usuário"
                                                                    onclick="confirmDelete({{ $user->id }}, '{{ $user->name }}')">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-5">
                                                <div class="text-muted">
                                                    <i class="fas fa-users fa-3x mb-3 opacity-50"></i>
                                                    <h5>Nenhum usuário encontrado</h5>
                                                    <p class="mb-0">Não há usuários cadastrados no sistema.</p>
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
    @endif

    {{-- Perfil do usuário normal --}}
    @if ($groupId === 3)
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <!-- Card Header -->
                    <div class="card-header bg-gradient-success text-white border-bottom-0 py-4">
                        <h4 class="card-title mb-0 fw-bold">
                            <i class="fas fa-user-circle me-2"></i>
                            Meu Perfil
                        </h4>
                        <p class="mb-0 opacity-75">Informações da sua conta no sistema</p>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-3 text-center mb-4">
                                <div class="bg-success bg-opacity-10 rounded-circle p-4 d-inline-block mb-3">
                                    <i class="fas fa-user fa-4x text-success"></i>
                                </div>
                                <h5 class="fw-bold text-success">{{ Auth::user()->name }}</h5>
                                <span class="badge bg-success bg-opacity-25 text-success px-3 py-2">
                                    <i class="fas fa-user me-1"></i>
                                    {{ Auth::user()->userGroup->name ?? '—' }}
                                </span>
                            </div>
                            <div class="col-md-9">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="border rounded p-3 h-100">
                                            <h6 class="text-muted mb-2">
                                                <i class="fas fa-hashtag me-2"></i>ID do Usuário
                                            </h6>
                                            <p class="fw-bold mb-0">#{{ Auth::user()->id }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="border rounded p-3 h-100">
                                            <h6 class="text-muted mb-2">
                                                <i class="fas fa-envelope me-2"></i>Email
                                            </h6>
                                            <p class="fw-bold mb-0">{{ Auth::user()->email }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="border rounded p-3 h-100">
                                            <h6 class="text-muted mb-2">
                                                <i class="fas fa-calendar-plus me-2"></i>Membro desde
                                            </h6>
                                            <p class="fw-bold mb-0">{{ Auth::user()->created_at->format('d/m/Y H:i') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 d-flex align-items-end">
                                        <a href="{{ route('users.edit', Auth::id()) }}" 
                                           class="btn btn-success w-100">
                                            <i class="fas fa-user-edit me-2"></i>Editar Perfil
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Paginação --}}
    @if (in_array($groupId, [1, 2]) && method_exists($users, 'links'))
        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-center">
                <div class="card border-0 shadow-sm">
                    <div class="card-body py-3">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endif
        <div class="row mt-4">
            <div class="col-12">
                <div class="card bg-light border-0">
                    <div class="card-body py-4">
                        <div class="row align-items-center">
                            <div class="col-md-2 text-center">
                                <i class="fas fa-info-circle fa-3x text-primary"></i>
                            </div>
                            <div class="col-md-8">
                                <h6 class="mb-2">Sobre o Sistema de Usuários</h6>
                                <p class="text-muted small mb-0">
                                    O sistema de usuários permite o gerenciamento eficiente de perfis e permissões.
                                    Os usuários são organizados por grupos e níveis de acesso para facilitar a administração e controle.
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
                    <i class="fas fa-user-times fa-3x text-danger mb-3"></i>
                    <h6>Tem certeza que deseja excluir este usuário?</h6>
                    <p class="text-muted mb-0">
                        Usuário: <strong id="userName"></strong><br>
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

.bg-gradient-success {
    background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
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
function confirmDelete(userId, userName) {
    document.getElementById('userName').textContent = userName;
    document.getElementById('deleteForm').action = `/users/${userId}`;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>
@endsection