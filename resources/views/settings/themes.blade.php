@extends('layouts.app') <!-- Ou seu layout principal -->

@section('title', 'Temas')

@section('content')
<div class="container">
    <h1>Configurações de Temas</h1>
    <p>Aqui você pode escolher o tema do sistema.</p>

    <!-- Exemplo simples de seleção de tema -->
    <form action="{{ route('settings.themes.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="theme">Selecione o tema:</label>
            <select name="theme" id="theme" class="form-control">
                <option value="default" {{ (old('theme', $currentTheme ?? '') == 'default') ? 'selected' : '' }}>Padrão</option>
                <option value="dark" {{ (old('theme', $currentTheme ?? '') == 'dark') ? 'selected' : '' }}>Escuro</option>
                <option value="light" {{ (old('theme', $currentTheme ?? '') == 'light') ? 'selected' : '' }}>Claro</option>
                <!-- Adicione mais temas aqui -->
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
@endsection
