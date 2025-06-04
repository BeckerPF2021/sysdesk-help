@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Novo Tipo de Interação</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('interaction-types.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required maxlength="100">
        </div>
        <button class="btn btn-success mt-2" type="submit">Salvar</button>
        <a href="{{ route('interaction-types.index') }}" class="btn btn-secondary mt-2">Cancelar</a>
    </form>
</div>
@endsection