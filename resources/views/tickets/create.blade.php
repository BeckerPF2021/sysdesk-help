@extends('layouts.app')

@section('title', 'Criar Novo Ticket')

@section('content')
<div class="container mt-5">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h1 class="text-primary fw-bold">
            <i class="fas fa-plus me-2"></i> Criar Novo Ticket
        </h1>
        <a href="{{ route('tickets.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Voltar
        </a>
    </div>

    {{-- Erros de validação --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Erros encontrados:</strong>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    @endif

    <form action="{{ route('tickets.store') }}" method="POST" novalidate>
        @csrf

        {{-- Informações do Ticket --}}
        <div class="mb-4 card shadow-sm border-0 rounded-4 bg-light bg-opacity-75">
            <div class="card-body">
                <h5 class="mb-3 text-primary"><i class="fas fa-ticket-alt me-2"></i> Informações do Ticket</h5>
                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="title" class="form-label fw-semibold">
                            <i class="fas fa-heading me-1"></i> Título <span class="text-danger">*</span>
                        </label>
                        <input type="text" id="title" name="title" class="form-control"
                            value="{{ old('title') }}" placeholder="Digite o título do ticket" required autofocus>
                    </div>
                    <div class="col-md-6">
                        <label for="fk_ticket_priority_id" class="form-label fw-semibold">
                            <i class="fas fa-exclamation-triangle me-1"></i> Prioridade <span class="text-danger">*</span>
                        </label>
                        <select id="fk_ticket_priority_id" name="fk_ticket_priority_id" class="form-select" required>
                            <option value="" disabled selected>Selecione a prioridade</option>
                            @foreach ($ticketPriorities as $priority)
                                <option value="{{ $priority->id }}" {{ old('fk_ticket_priority_id') == $priority->id ? 'selected' : '' }}>
                                    {{ $priority->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="description" class="form-label fw-semibold">
                            <i class="fas fa-align-left me-1"></i> Descrição <span class="text-danger">*</span>
                        </label>
                        <textarea id="description" name="description" rows="4" class="form-control"
                            placeholder="Descreva detalhadamente o problema" required>{{ old('description') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- Responsáveis --}}
        <div class="mb-4 card shadow-sm border-0 rounded-4 bg-light bg-opacity-75">
            <div class="card-body">
                <h5 class="mb-3 text-primary"><i class="fas fa-users me-2"></i> Responsáveis</h5>
                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="fk_user_id" class="form-label fw-semibold">
                            <i class="fas fa-user me-1"></i> Usuário <span class="text-danger">*</span>
                        </label>
                        <select id="fk_user_id" name="fk_user_id" class="form-select" required>
                            <option value="" disabled selected>Selecione o usuário</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ old('fk_user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="fk_responsible_user_id" class="form-label fw-semibold">
                            <i class="fas fa-user-cog me-1"></i> Responsável (opcional)
                        </label>
                        <select id="fk_responsible_user_id" name="fk_responsible_user_id" class="form-select">
                            <option value="" selected>-- Nenhum responsável --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ old('fk_responsible_user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- Detalhes Adicionais --}}
        <div class="mb-4 card shadow-sm border-0 rounded-4 bg-light bg-opacity-75">
            <div class="card-body">
                <h5 class="mb-3 text-primary"><i class="fas fa-tags me-2"></i> Detalhes Adicionais</h5>
                <div class="row g-4">
                    <div class="col-md-4">
                        <label for="fk_category_id" class="form-label fw-semibold">
                            <i class="fas fa-list-alt me-1"></i> Categoria <span class="text-danger">*</span>
                        </label>
                        <select id="fk_category_id" name="fk_category_id" class="form-select" required>
                            <option value="" disabled selected>Selecione a categoria</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('fk_category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="fk_ticket_status_id" class="form-label fw-semibold">
                            <i class="fas fa-info-circle me-1"></i> Status <span class="text-danger">*</span>
                        </label>
                        <select id="fk_ticket_status_id" name="fk_ticket_status_id" class="form-select" required>
                            <option value="" disabled selected>Selecione o status</option>
                            @foreach ($ticketStatuses as $status)
                                <option value="{{ $status->id }}" {{ old('fk_ticket_status_id') == $status->id ? 'selected' : '' }}>
                                    {{ $status->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="fk_department_id" class="form-label fw-semibold">
                            <i class="fas fa-building me-1"></i> Departamento <span class="text-danger">*</span>
                        </label>
                        <select id="fk_department_id" name="fk_department_id" class="form-select" required>
                            <option value="" disabled selected>Selecione o departamento</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}" {{ old('fk_department_id') == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- Botões --}}
        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary btn-lg px-4">
                <i class="fas fa-plus me-2"></i> Criar Ticket
            </button>
        </div>
    </form>
</div>
@endsection
