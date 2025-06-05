@extends('layouts.app') {{-- ou seu layout base --}}

@section('title', 'Acesso Negado')

@section('content')
<div class="container text-center mt-5">
    <h1 class="display-4">403 - Acesso Negado</h1>
    <p class="lead">Você não tem permissão para acessar esta funcionalidade.</p>

    <a href="{{ url()->previous() }}" class="btn btn-primary">
        Voltar
    </a>
</div>
@endsection
