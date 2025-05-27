@extends('layouts.app')

@section('title', 'Criar Novo Ticket')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Criar Novo Ticket</h1>

    <!-- Exibição de erros de validação -->
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tickets.store') }}" method="POST" novalidate>
        @csrf

        <div class="mb-4 row g-3">
            <div class="col-md-6">
                <label for="title" class="form-label fw-semibold">
                    <i class="fas fa-heading me-1"></i> Título <span class="text-danger">*</span>
                </label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    class="form-control form-control-lg"
                    value="{{ old('title') }}"
                    placeholder="Digite o título do ticket"
                    required
                    autofocus
                    aria-describedby="titleHelp"
                >
                <div id="titleHelp" class="form-text">Título claro e objetivo do problema</div>
            </div>

            <div class="col-md-6">
                <label for="fk_ticket_priority_id" class="form-label fw-semibold">
                    <i class="fas fa-exclamation-triangle me-1"></i> Prioridade <span class="text-danger">*</span>
                </label>
                <select
                    id="fk_ticket_priority_id"
                    name="fk_ticket_priority_id"
                    class="form-select form-select-lg"
                    required
                    aria-describedby="priorityHelp"
                >
                    <option value="" disabled selected>Selecione a prioridade</option>
                    @foreach ($ticketPriorities as $priority)
                        <option value="{{ $priority->id }}" {{ old('fk_ticket_priority_id') == $priority->id ? 'selected' : '' }}>
                            {{ $priority->name }}
                        </option>
                    @endforeach
                </select>
                <div id="priorityHelp" class="form-text">Selecione a prioridade do ticket</div>
            </div>
        </div>

        <div class="mb-4">
            <label for="description" class="form-label fw-semibold">
                <i class="fas fa-align-left me-1"></i> Descrição <span class="text-danger">*</span>
            </label>
            <textarea
                id="description"
                name="description"
                rows="5"
                class="form-control form-control-lg"
                placeholder="Descreva detalhadamente o problema"
                required
                aria-describedby="descriptionHelp"
            >{{ old('description') }}</textarea>
            <div id="descriptionHelp" class="form-text">Quanto mais detalhes, melhor para o suporte</div>
        </div>

        <div class="mb-4 row g-3">
            <div class="col-md-6">
                <label for="fk_user_id" class="form-label fw-semibold">
                    <i class="fas fa-user me-1"></i> Usuário <span class="text-danger">*</span>
                </label>
                <select
                    id="fk_user_id"
                    name="fk_user_id"
                    class="form-select form-select-lg"
                    required
                    aria-describedby="userHelp"
                >
                    <option value="" disabled selected>Selecione o usuário responsável pelo chamado</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('fk_user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                <div id="userHelp" class="form-text">Usuário que abriu o ticket</div>
            </div>

            <div class="col-md-6">
                <label for="fk_responsible_user_id" class="form-label fw-semibold">
                    <i class="fas fa-user-cog me-1"></i> Responsável (opcional)
                </label>
                <select
                    id="fk_responsible_user_id"
                    name="fk_responsible_user_id"
                    class="form-select form-select-lg"
                    aria-describedby="responsibleHelp"
                >
                    <option value="" selected>-- Nenhum responsável --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('fk_responsible_user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                <div id="responsibleHelp" class="form-text">Responsável pelo atendimento do ticket</div>
            </div>
        </div>

        <div class="mb-4 row g-3">
            <div class="col-md-4">
                <label for="fk_category_id" class="form-label fw-semibold">
                    <i class="fas fa-list-alt me-1"></i> Categoria <span class="text-danger">*</span>
                </label>
                <select
                    id="fk_category_id"
                    name="fk_category_id"
                    class="form-select form-select-lg"
                    required
                    aria-describedby="categoryHelp"
                >
                    <option value="" disabled selected>Selecione a categoria do ticket</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('fk_category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <div id="categoryHelp" class="form-text">Escolha a categoria apropriada</div>
            </div>

            <div class="col-md-4">
                <label for="fk_ticket_status_id" class="form-label fw-semibold">
                    <i class="fas fa-info-circle me-1"></i> Status <span class="text-danger">*</span>
                </label>
                <select
                    id="fk_ticket_status_id"
                    name="fk_ticket_status_id"
                    class="form-select form-select-lg"
                    required
                    aria-describedby="statusHelp"
                >
                    <option value="" disabled selected>Selecione o status atual</option>
                    @foreach ($ticketStatuses as $status)
                        <option value="{{ $status->id }}" {{ old('fk_ticket_status_id') == $status->id ? 'selected' : '' }}>
                            {{ $status->name }}
                        </option>
                    @endforeach
                </select>
                <div id="statusHelp" class="form-text">Status atual do ticket</div>
            </div>

            <div class="col-md-4">
                <label for="fk_department_id" class="form-label fw-semibold">
                    <i class="fas fa-building me-1"></i> Departamento <span class="text-danger">*</span>
                </label>
                <select
                    id="fk_department_id"
                    name="fk_department_id"
                    class="form-select form-select-lg"
                    required
                    aria-describedby="departmentHelp"
                >
                    <option value="" disabled selected>Selecione o departamento responsável</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}" {{ old('fk_department_id') == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
                <div id="departmentHelp" class="form-text">Departamento que irá tratar o ticket</div>
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="px-4 btn btn-lg btn-primary">
                <i class="fas fa-plus me-2"></i> Criar Ticket
            </button>
        </div>
    </form>
</div>
@endsection
