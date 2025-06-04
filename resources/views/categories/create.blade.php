@extends('layouts.app')

@section('title', 'Criar Categoria')

@section('content')
<div class="container mt-4" style="max-width: 600px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">
    <h1 class="mb-4 font-weight-bold" style="font-size: 2rem; letter-spacing: 0.02em;">
        Criar Nova Categoria
    </h1>

    {{-- Exibe erros de validação --}}
    @if ($errors->any())
        <div class="alert alert-danger shadow-sm" style="font-size: 1rem;">
            <ul class="mb-0 pl-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm p-4 bg-white rounded">
        <form action="{{ route('categories.store') }}" method="POST" style="font-size: 1.1rem;">
            @csrf

            <div class="form-group mb-4">
                <label for="name" class="font-weight-bold">Nome</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    class="form-control form-control-lg" 
                    required 
                    autofocus
                    style="font-size: 1.1rem;"
                    value="{{ old('name') }}"
                >
            </div>

            <div class="d-flex">
                <button type="submit" class="btn btn-primary btn-lg font-weight-bold mr-2 shadow-sm">
                    Criar Categoria
                </button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-lg font-weight-bold shadow-sm">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
