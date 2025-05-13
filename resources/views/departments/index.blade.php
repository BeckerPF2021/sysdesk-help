@extends('layouts.app')

@section('title', 'Departamentos')

@section('content')
<div class="container mt-4">
    <div class="mb-4 shadow-sm card">
        <div class="text-white card-header bg-primary">
            <h5 class="mb-0">Departamentos</h5>
        </div>
        <div class="card-body">
            <a href="{{ route('departments.create') }}" class="mb-3 btn btn-primary">Criar Novo Departamento</a>

            <!-- Exibe erros de validação -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departments as $department)
                        <tr>
                            <td>{{ $department->id }}</td>
                            <td>{{ $department->name }}</td>
                            <td>
                                <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('departments.destroy', $department->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Tem certeza de que deseja excluir este departamento?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
