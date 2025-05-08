<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            margin-bottom: 30px;
        }
        .card {
            border-radius: 12px;
        }
        .card-icon {
            font-size: 2rem;
            margin-right: 10px;
        }
    </style>
</head>
<body>

<!-- Navbar padrão Laravel -->
<nav class="bg-white shadow-sm navbar navbar-expand-lg navbar-light border-bottom">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            {{ config('app.name', 'Laravel') }}
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="ml-auto navbar-nav">
                @auth
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link active">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Manage Users</a>
                        <div class="dropdown-menu">
                            <a href="{{ route('user-groups.index') }}" class="dropdown-item">User Groups</a>
                            <a href="{{ route('users.index') }}" class="dropdown-item">Users</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Departments</a>
                        <div class="dropdown-menu">
                            <a href="{{ route('departments.index') }}" class="dropdown-item">Departments</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Categories</a>
                        <div class="dropdown-menu">
                            <a href="{{ route('categories.index') }}" class="dropdown-item">Categories</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Ticket Statuses</a>
                        <div class="dropdown-menu">
                            <a href="{{ route('ticket-statuses.index') }}" class="dropdown-item">Ticket Statuses</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Ticket Priority</a>
                        <div class="dropdown-menu">
                            <a href="{{ route('ticket-priorities.index') }}" class="dropdown-item">Ticket Priority</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Ticket</a>
                        <div class="dropdown-menu">
                            <a href="{{ route('tickets.index') }}" class="dropdown-item">Ticket</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="{{ route('profile.edit') }}" class="dropdown-item">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Conteúdo do Dashboard -->
<div class="container">
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
                    <a href="{{ route('users.index') }}" class="btn btn-primary">Ver Usuários</a>
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
                    <a href="{{ route('user-groups.index') }}" class="btn btn-success">Ver Grupos</a>
                </div>
            </div>
        </div>

        <!-- Card: Último Usuário -->
        <div class="mb-4 col-md-6">
            <div class="shadow-sm card">
                <div class="text-white card-header bg-info d-flex align-items-center">
                    <span class="card-icon">&#128221;</span>
                    <h5 class="mb-0">Último Usuário Registrado</h5>
                </div>
                <div class="card-body">
                    @if ($users->count() > 0)
                        <h5 class="card-title">{{ $users->last()->name }}</h5>
                        <p class="card-text">Email: {{ $users->last()->email }}</p>
                        <p class="text-muted">Criado em: {{ $users->last()->created_at->format('d/m/Y H:i') }}</p>
                    @else
                        <p class="card-text text-muted">Nenhum usuário cadastrado ainda.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Card: Último Grupo Criado -->
        <div class="mb-4 col-md-6">
            <div class="shadow-sm card">
                <div class="card-header bg-warning text-dark d-flex align-items-center">
                    <span class="card-icon">&#128193;</span>
                    <h5 class="mb-0">Último Grupo Criado</h5>
                </div>
                <div class="card-body">
                    @if ($userGroups->count() > 0)
                        <h5 class="card-title">{{ $userGroups->last()->name }}</h5>
                        <p class="text-muted">Criado em: {{ $userGroups->last()->created_at->format('d/m/Y H:i') }}</p>
                    @else
                        <p class="card-text text-muted">Nenhum grupo registrado ainda.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
