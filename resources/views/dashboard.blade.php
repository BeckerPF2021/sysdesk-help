<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="text-center jumbotron">
        <h1 class="display-4">Olá, {{ Auth::user()->name }}!</h1>
        <p class="lead">Bem-vindo ao painel de administração do sistema.</p>
        <hr class="my-4">
        <p>Gerencie usuários, grupos e configurações da sua aplicação.</p>
    </div>

    <div class="row">
        <!-- Card: Total de Usuários -->
        <div class="mb-4 col-md-6">
            <div class="shadow-sm card">
                <div class="text-white card-header bg-primary d-flex align-items-center">
                    <span class="card-icon">&#128100;</span>
                    <h5 class="mb-0">Usuários Cadastrados</h5>
                </div>
                <div class="card-body">
                    <h2 class="card-title">{{ $users->count() }}</h2>
                    <p class="card-text">Total de usuários no sistema.</p>
                    <a href="{{ route('users.index') }}" class="btn btn-custom">Ver Usuários</a>
                </div>
            </div>
        </div>

        <!-- Card: Total de Grupos -->
        <div class="mb-4 col-md-6">
            <div class="shadow-sm card">
                <div class="text-white card-header bg-success d-flex align-items-center">
                    <span class="card-icon">&#128101;</span>
                    <h5 class="mb-0">Grupos de Usuários</h5>
                </div>
                <div class="card-body">
                    <h2 class="card-title">{{ $userGroups->count() }}</h2>
                    <p class="card-text">Total de grupos registrados.</p>
                    <a href="{{ route('user-groups.index') }}" class="btn btn-custom">Ver Grupos</a>
                </div>
            </div>
        </div>
    </div>
@endsection
