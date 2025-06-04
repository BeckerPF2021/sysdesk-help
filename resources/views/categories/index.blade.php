@extends('layouts.app')

@section('title', 'Lista de Categorias')

@section('content')
<div class="container mt-5">
    <div class="flex-wrap mb-4 d-flex justify-content-between align-items-center">
        <h1 class="mb-3 text-primary fw-bold">
            <i class="fas fa-folder-open me-2"></i> Lista de Categorias
        </h1>
        <a href="{{ route('categories.create') }}" class="mb-3 shadow-sm btn btn-primary fw-semibold">
            <i class="fas fa-plus me-1"></i> Nova Categoria
        </a>
    </div>

    {{-- Mensagem de sucesso --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    @endif

    <div class="table-responsive shadow rounded">
        <table class="table table-hover table-striped text-nowrap mb-0 align-middle" style="font-size: 0.93rem;">
            <thead class="text-center table-light">
                <tr>
                    <th style="width: 10%;">ID</th>
                    <th>Nome</th>
                    <th style="width: 20%;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td class="text-center">{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td class="text-center">
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning me-1" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Deseja realmente excluir esta categoria?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Excluir">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted">Nenhuma categoria encontrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection