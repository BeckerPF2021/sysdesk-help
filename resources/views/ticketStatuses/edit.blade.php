@extends('layouts.app')

@section('title', 'Editar Status de Ticket')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Editar Status de Ticket</h1>

    {{-- Exibe erros de validação --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ticket-statuses.update', $ticketStatus->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nome do Status</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $ticketStatus->name) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="{{ route('ticket-statuses.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
