<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', config('app.name'))</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <style>
    body {
      margin: 0;
      font-family: 'Arial', sans-serif;
      display: flex;
      height: 100vh;
      background-color: #f4f6f9;
      overflow-y: auto;
    }

    .sidebar {
      width: 250px;
      background-color: rgba(52, 58, 64, 0.9);
      color: white;
      position: fixed;
      top: 0;
      left: 0;
      bottom: 0;
      padding-top: 30px;
      transition: all 0.3s ease;
      overflow-y: auto;
      padding-left: 20px;
    }

    .sidebar h4 {
      text-align: center;
      color: #fff;
      font-size: 1.125rem;
      margin-bottom: 20px;
    }

    .sidebar .user-name {
      color: #fff;
      font-size: 0.9rem;
      margin-bottom: 20px;
      font-weight: bold;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
    }

    .sidebar .user-name img {
      border-radius: 50%;
      width: 40px;
      height: 40px;
      margin-right: 10px;
    }

    .sidebar a,
    .sidebar .menu-item > a {
      color: white;
      text-decoration: none;
      padding: 12px 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      transition: background-color 0.3s ease;
      font-size: 0.95rem;
      width: 100%;
    }

    .sidebar a:hover {
      background-color: #495057;
    }

    .sidebar .menu-item > a span {
      display: flex;
      align-items: center;
    }

    .sidebar i.fas {
      margin-right: 10px;
      width: 20px;
      text-align: center;
    }

    .submenu {
      display: none;
      flex-direction: column;
      padding-left: 20px;
    }

    .submenu a {
      font-size: 0.95rem;
      padding: 8px 20px;
      display: flex;
      align-items: center;
      color: #dee2e6;
      transition: background-color 0.2s ease;
    }

    .submenu a i {
      margin-right: 10px;
      width: 20px;
      text-align: center;
    }

    .submenu a span {
      display: flex;
      align-items: center;
    }

    .submenu a:hover {
      background-color: #495057;
      color: white;
    }

    .content {
      margin-left: 250px;
      flex: 1;
      padding: 20px;
      transition: margin-left 0.3s ease;
      overflow-y: auto;
      padding-top: 50px;
    }

    #toggleSidebar {
      display: none;
    }

    @media (max-width: 768px) {
      .sidebar {
        position: absolute;
        width: 100%;
        height: auto;
        top: 0;
        left: -100%;
        z-index: 999;
        transition: all 0.3s;
      }

      .sidebar.active {
        left: 0;
      }

      .content {
        margin-left: 0;
      }

      #toggleSidebar {
        display: block;
        background-color: #343a40;
        color: white;
        padding: 10px;
        border: none;
        font-size: 24px;
      }
    }
  </style>
</head>
<body>

<!-- Barra Lateral -->
<div class="sidebar" id="sidebar">
  @auth
  <div class="user-name">
    <img src="{{ Auth::user()->profile_picture_url ?? 'https://www.gravatar.com/avatar/' . md5(strtolower(trim(Auth::user()->email))) . '?d=mp' }}" alt="User Photo">
    <span>{{ Auth::user()->name }}</span>
  </div>
  @endauth

  <h4>Meu Sistema</h4>
  <div class="d-flex flex-column">
    <div class="menu-item">
      <a href="javascript:void(0);">
        <span><i class="fas fa-tachometer-alt"></i> Dashboard</span>
        <i class="fas fa-chevron-down"></i>
      </a>
      <div class="submenu">
        <a href="{{ route('dashboard') }}"><span><i class="fas fa-home"></i> Início</span></a>
        <a href="#"><span><i class="fas fa-chart-line"></i> Resumo</span></a>
      </div>
    </div>

    <div class="menu-item">
      <a href="javascript:void(0);">
        <span><i class="fas fa-users"></i> Usuários</span>
        <i class="fas fa-chevron-down"></i>
      </a>
      <div class="submenu">
        <a href="{{ route('users.index') }}"><span><i class="fas fa-list"></i> Listar</span></a>
        <a href="{{ route('users.create') }}"><span><i class="fas fa-user-plus"></i> Cadastrar</span></a>
      </div>
    </div>

    <a href="{{ route('user-groups.index') }}">
      <span><i class="fas fa-users-cog"></i> Grupos de Usuários</span>
    </a>

    <a href="{{ route('departments.index') }}">
      <span><i class="fas fa-building"></i> Departamentos</span>
    </a>

    <div class="menu-item">
      <a href="javascript:void(0);">
        <span><i class="fas fa-ticket-alt"></i> Chamados</span>
        <i class="fas fa-chevron-down"></i>
      </a>
      <div class="submenu">
        <a href="{{ route('tickets.index') }}"><span><i class="fas fa-list-alt"></i> Listar</span></a>
        <a href="{{ route('tickets.create') }}"><span><i class="fas fa-plus"></i> Cadastrar</span></a>
        <a href="{{ route('ticket-statuses.index') }}"><span><i class="fas fa-toggle-on"></i> Status</span></a>
        <a href="{{ route('ticket-priorities.index') }}"><span><i class="fas fa-exclamation-circle"></i> Prioridades</span></a>
        <a href="{{ route('categories.index') }}"><span><i class="fas fa-tags"></i> Categorias</span></a>
      </div>
    </div>

    <a href="{{ route('profile.edit') }}">
      <span><i class="fas fa-user-circle"></i> Perfil</span>
    </a>

    <form action="{{ route('logout') }}" method="POST" class="p-0">
      @csrf
      <button type="submit" class="text-white btn btn-link" style="background-color: transparent; border: none;">
        <i class="fas fa-sign-out-alt"></i> Sair
      </button>
    </form>
  </div>
</div>

<!-- Conteúdo Principal -->
<div class="content">
  <main class="py-4">
    @yield('content')
  </main>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  $('#toggleSidebar').on('click', function () {
    $('#sidebar').toggleClass('active');
  });

  $('.menu-item > a').on('click', function () {
    const submenu = $(this).next('.submenu');
    $('.submenu').not(submenu).slideUp();
    submenu.slideToggle();
    $('.menu-item i.fas.fa-chevron-down').not($(this).find('i')).removeClass('rotated');
    $(this).find('i').toggleClass('rotated');
  });
</script>
</body>
</html>
