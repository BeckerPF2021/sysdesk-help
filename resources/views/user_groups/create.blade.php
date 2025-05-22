<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Grupo de Usuário</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        .main-wrapper {
            display: flex;
            flex: 1;
        }

        .sidebar {
            width: 250px;
            background-color: #343a40;
            padding: 1rem;
            min-height: 100vh;
        }

        .sidebar a {
            color: #fff;
            display: block;
            padding: 10px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .content {
            flex: 1;
            padding: 2rem;
        }

        .navbar {
            z-index: 1030;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="bg-white shadow-sm navbar navbar-expand-lg navbar-light border-bottom">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <div class="main-wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <h5 class="text-white">Menu</h5>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('users.index') }}">Usuários</a>
            <a href="{{ route('user-groups.index') }}">Grupos de Usuário</a>
            @auth
                <a href="{{ route('profile.edit') }}">Perfil</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="p-0 pl-2 text-white btn btn-link" type="submit">Logout</button>
                </form>
            @endauth
        </div>

        <!-- Conteúdo -->
        <div class="content">
            <h1 class="mb-4">Criar Grupo de Usuário</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('user-groups.store') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Nome do Grupo</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Criar</button>
                <a href="{{ route('user-groups.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
