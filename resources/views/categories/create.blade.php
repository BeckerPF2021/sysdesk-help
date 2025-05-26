@extends('layouts.app')

@section('title', 'Criar Categoria')

@section('content')
<div class="container mt-4" style="max-width: 600px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">
    <h1 class="mb-4 font-weight-bold" style="font-size: 2rem; letter-spacing: 0.02em;">
        Criar Nova Categoria
    </h1>

    {{-- Exibe erros de validação --}}
    @if ($errors->any())
        <div class="alert alert-danger" style="font-size: 1rem;">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.store') }}" method="POST" style="font-size: 1.1rem;">
        @csrf

        <div class="form-group">
            <label for="name" style="font-weight: 600;">Nome</label>
            <input type="text" id="name" name="name" class="form-control form-control-lg" required autofocus
                   style="font-size: 1.1rem;">
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary btn-lg font-weight-bold" style="font-size: 1.1rem;">
                Criar Categoria
            </button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-lg font-weight-bold" style="font-size: 1.1rem;">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
