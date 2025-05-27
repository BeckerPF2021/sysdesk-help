@extends('layouts.app')

@section('title', 'Editar Ticket')

@section('content')
    <h1 class="mb-4">Editar Ticket</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $ticket->title) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea id="description" name="description" class="form-control" required>{{ old('description', $ticket->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="fk_user_id">Usuário</label>
            <select id="fk_user_id" name="fk_user_id" class="form-control" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ old('fk_user_id', $ticket->fk_user_id) == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="fk_responsible_user_id">Responsável</label>
            <select id="fk_responsible_user_id" name="fk_responsible_user_id" class="form-control" required>
                @foreach ($responsibleUsers as $responsible)
                    <option value="{{ $responsible->id }}" {{ old('fk_responsible_user_id', $ticket->fk_responsible_user_id) == $responsible->id ? 'selected' : '' }}>
                        {{ $responsible->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="fk_category_id">Categoria</label>
            <select id="fk_category_id" name="fk_category_id" class="form-control" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('fk_category_id', $ticket->fk_category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="fk_ticket_status_id">Status</label>
            <select id="fk_ticket_status_id" name="fk_ticket_status_id" class="form-control" required>
                @foreach ($ticketStatuses as $status)
                    <option value="{{ $status->id }}" {{ old('fk_ticket_status_id', $ticket->fk_ticket_status_id) == $status->id ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="fk_department_id">Departamento</label>
            <select id="fk_department_id" name="fk_department_id" class="form-control" required>
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}" {{ old('fk_department_id', $ticket->fk_department_id) == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="fk_ticket_priority_id">Prioridade</label>
            <select id="fk_ticket_priority_id" name="fk_ticket_priority_id" class="form-control" required>
                @foreach ($ticketPriorities as $priority)
                    <option value="{{ $priority->id }}" {{ old('fk_ticket_priority_id', $ticket->fk_ticket_priority_id) == $priority->id ? 'selected' : '' }}>
                        {{ $priority->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </form>
@endsection
