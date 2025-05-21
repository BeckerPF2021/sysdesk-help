<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sysdesk Help</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('{{ asset('images/fundo.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            position: relative;
        }

        .overlay {
            backdrop-filter: blur(6px);
            background-color: rgba(255, 255, 255, 0.3); /* semitransparente */
            height: 100%;
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1; /* Coloca a overlay atrás de outros elementos */
        }

        .content {
            position: relative;
            z-index: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%; /* Garante que o conteúdo ocupe toda a altura da tela */
            text-align: center;
            padding-top: 50px; /* Adiciona espaçamento acima do conteúdo */
        }

        .logo {
            max-width: 150px; /* Logo pequena */
            margin-bottom: 20px;
        }

        .navbar {
            margin-bottom: 30px;
            position: relative; /* Impede que a navbar seja sobreposta pela imagem */
            z-index: 2; /* Garante que a navbar fique acima da overlay */
        }

        .navbar-nav {
            width: 100%; /* Faz com que o menu ocupe toda a largura da navbar */
            justify-content: center; /* Centraliza os itens no menu */
        }

        .navbar-toggler {
            border-color: transparent; /* Remove a borda do botão de alternância */
        }

    </style>
</head>
<body>

    <div class="overlay"></div>

    <div class="content">
        <!-- Navbar -->
        <nav class="bg-white shadow-sm navbar navbar-expand-lg navbar-light border-bottom">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Sysdesk Help') }}
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Registrar</a>
                                </li>
                            @endif
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Conteúdo -->
        <div class="container">
            <div class="jumbotron text-center bg-white bg-opacity-75 rounded">
                <!-- Logo Centralizada e Pequena -->
                <img src="{{ asset('images/sysdesk_help_logo.png') }}" alt="Sysdesk Help Logo" class="logo img-fluid">
                <h1 class="display-4">Bem-vindo ao Sysdesk Help</h1>
                <p class="lead">Sistema de helpdesk para gerenciamento de chamados técnicos.</p>
            </div>
        </div>
    </div>

    <!-- Scripts do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>