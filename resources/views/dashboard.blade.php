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
                        <li class="nav-item">
                            <a href="{{ route('user-groups.index') }}" class="nav-link">User Groups</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link">Users</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
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
        <div class="jumbotron text-center">
            <h1 class="display-4">Welcome, {{ Auth::user()->name }}!</h1>
            <p class="lead">This is your dashboard.</p>
            <hr class="my-4">
            <p>Manage your user groups or update your profile below.</p>
            <a class="btn btn-primary btn-lg" href="{{ route('user-groups.index') }}" role="button">Manage User Groups</a>
            <a class="btn btn-outline-secondary btn-lg" href="{{ route('users.index') }}" role="button">View Users</a>
            <a class="btn btn-outline-info btn-lg" href="{{ route('profile.edit') }}" role="button">Edit Profile</a>
        </div>
    </div>

    <!-- Scripts do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
