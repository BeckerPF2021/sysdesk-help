@extends('layouts.app')

@section('title', 'Editar Departamento')

@section('content')
<div class="container mt-4" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0 font-weight-bold">Editar Departamento</h5>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('departments.update', $department->id) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nome do Departamento</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $department->name) }}" required>
                </div>

                <button type="submit" class="btn btn-primary mt-4 font-weight-bold">Atualizar Departamento</button>
                <a href="{{ route('departments.index') }}" class="btn btn-secondary mt-4 font-weight-bold">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
