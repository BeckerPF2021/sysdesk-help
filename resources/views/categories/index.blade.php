@extends('layouts.app')

@section('title', 'Lista de Categorias')

@section('content')
<div class="container mt-4" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">
    <h1 class="mb-4 font-weight-bold" style="font-size: 2rem;">Lista de Categorias</h1>

    @if (session('success'))
        <div class="alert alert-success" style="font-size: 1rem;">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('categories.create') }}" class="mb-4 btn btn-primary btn-lg font-weight-bold" style="font-size: 1.1rem;">
        Criar Nova Categoria
    </a>

    <div class="table-responsive">
        <table class="table table-bordered table-hover" style="font-size: 1.1rem;">
            <thead class="thead-light">
                <tr>
                    <th style="width: 10%;">ID</th>
                    <th>Nome</th>
                    <th style="width: 20%;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">
                                Editar
                            </a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Deseja realmente excluir esta categoria?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center font-italic text-muted">Nenhuma categoria encontrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
