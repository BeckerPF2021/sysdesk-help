@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tipos de Interação</h1>
    <a href="{{ route('interaction-types.create') }}" class="btn btn-primary mb-3">Novo Tipo</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($interactionTypes->count())
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($interactionTypes as $type)
            <tr>
                <td>{{ $type->id }}</td>
                <td>{{ $type->name }}</td>
                <td>
                    <a href="{{ route('interaction-types.edit', $type) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('interaction-types.destroy', $type) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Confirma exclusão?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>Nenhum tipo de interação cadastrado.</p>
    @endif
</div>
@endsection
