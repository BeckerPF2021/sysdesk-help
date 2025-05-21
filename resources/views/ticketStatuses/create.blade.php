@extends('layouts.app')

@section('title', 'Criar Novo Status de Ticket')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Criar Novo Status de Ticket</h1>

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

    <form action="{{ route('ticket-statuses.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nome do Status</label>
            <input type="text" class="form-control" id="name" name="name" required placeholder="Ex: Em andamento">
        </div>

        <button type="submit" class="btn btn-success">Criar Status</button>
        <a href="{{ route('ticket-statuses.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
