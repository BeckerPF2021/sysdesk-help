<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
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

    /* Sidebar minimizada por padrão */
    .sidebar {
      width: 60px; /* largura minimizada só ícones */
      background-color: rgba(52, 58, 64, 0.9);
      color: white;
      position: fixed;
      top: 0;
      left: 0;
      bottom: 0;
      padding-top: 10px;
      transition: width 0.3s ease;
      overflow-y: auto;
      z-index: 1000;
      white-space: nowrap;
    }
    /* Expande a sidebar quando o mouse está sobre ela */
    .sidebar:hover {
      width: 250px;
    }

    /* Esconder tudo que não for ícone quando minimizada */
    .sidebar:not(:hover) .user-name,
    .sidebar:not(:hover) h4,
    .sidebar:not(:hover) .menu-item > a span:not(.icon-only),
    .sidebar:not(:hover) a span:not(.icon-only),
    .sidebar:not(:hover) .submenu,
    .sidebar:not(:hover) form button span {
      display: none !important;
    }

    /* Mostrar os ícones sempre */
    .sidebar a,
    .sidebar .menu-item > a {
      color: white;
      text-decoration: none;
      padding: 12px 10px;
      display: flex;
      align-items: center;
      justify-content: flex-start;
      transition: background-color 0.3s ease;
      font-size: 0.95rem;
      cursor: pointer;
      position: relative;
    }
    .sidebar a:hover,
    .sidebar .menu-item > a:hover {
      background-color: #495057;
    }

    /* Ícones centralizados e com largura fixa */
    .sidebar i.fas {
      margin-right: 0;
      width: 40px;
      text-align: center;
      transition: transform 0.3s ease;
      flex-shrink: 0;
      font-size: 1.3rem;
    }
    /* Ícone para espaço no texto, oculto quando minimizado */
    .sidebar span.icon-only {
      margin-left: 10px;
    }
    /* Ícone chevron para abrir submenu, escondido minimizado */
    .sidebar:not(:hover) .menu-item > a i.fas.fa-chevron-down {
      display: none;
    }
    .sidebar:hover .menu-item > a i.fas.fa-chevron-down {
      margin-left: auto;
      margin-right: 10px;
      transition: transform 0.3s ease;
    }

    /* Rotacionar ícone quando submenu aberto */
    .rotated {
      transform: rotate(180deg);
    }

    /* Submenu */
    .submenu {
      display: none;
      flex-direction: column;
      padding-left: 10px;
      margin-left: 40px;
    }
    .sidebar:hover .submenu.show {
      display: flex;
    }
    .submenu a {
      font-size: 0.9rem;
      padding: 8px 12px;
      display: flex;
      align-items: center;
      color: #dee2e6;
      transition: background-color 0.2s ease;
      cursor: pointer;
      white-space: nowrap;
    }
    .submenu a i {
      margin-right: 10px;
      width: 20px;
      text-align: center;
    }
    .submenu a:hover {
      background-color: #495057;
      color: white;
    }

    /* Header user e título escondidos quando minimizada */
    .user-name {
      color: #fff;
      font-size: 0.9rem;
      margin-bottom: 20px;
      font-weight: bold;
      display: flex;
      align-items: center;
      justify-content: flex-start;
      padding-left: 10px;
    }
    .user-name img {
      border-radius: 50%;
      width: 40px;
      height: 40px;
      margin-right: 10px;
      object-fit: cover;
      flex-shrink: 0;
    }
    h4 {
      color: #fff;
      font-size: 1.125rem;
      margin-bottom: 15px;
      padding-left: 10px;
    }

    /* Conteúdo principal com margem dinâmica */
    .content {
      margin-left: 60px;
      flex: 1;
      padding: 20px;
      transition: margin-left 0.3s ease;
      overflow-y: auto;
      padding-top: 50px;
    }
    /* Expande margem quando sidebar hover */
    .sidebar:hover ~ .content {
      margin-left: 250px;
    }

    /* Botão toggle sidebar escondido (não usado aqui) */
    #toggleSidebar {
      display: none;
    }

    /* Responsivo */
    @media (max-width: 768px) {
      .sidebar {
        left: -250px !important;
        width: 250px !important;
        transition: left 0.3s ease !important;
      }
      .sidebar:hover {
        width: 250px !important;
      }
      .sidebar.active {
        left: 0 !important;
      }
      .content {
        margin-left: 0 !important;
        padding-top: 70px;
      }
      #toggleSidebar {
        display: block;
        position: fixed;
        top: 10px;
        left: 10px;
        z-index: 1100;
        background-color: #343a40;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 4px;
        font-size: 20px;
        cursor: pointer;
      }
      .sidebar:hover ~ .content {
        margin-left: 0 !important;
      }
    }
  </style>
</head>
<body>

<button id="toggleSidebar" aria-label="Toggle sidebar menu"><i class="fas fa-bars"></i></button>

<!-- Sidebar -->
<div class="sidebar" id="sidebar" role="navigation" aria-label="Sidebar menu" tabindex="0">
  @auth
  <div class="user-name">
    <img src="{{ Auth::user()->profile_picture_url ?? 'https://www.gravatar.com/avatar/' . md5(strtolower(trim(Auth::user()->email))) . '?d=mp&s=40' }}" alt="Foto do usuário">
    <span class="user-text"> {{ Auth::user()->name }} </span>
  </div>
  @endauth

  <h4>SysDesk</h4>

  <div class="d-flex flex-column">
    <div class="menu-item">
      <a href="javascript:void(0);" aria-expanded="false" aria-controls="submenu-dashboard" role="button" tabindex="0">
        <i class="fas fa-tachometer-alt"></i>
        <span class="icon-only">Dashboard</span>
        <i class="fas fa-chevron-down"></i>
      </a>
      <div class="submenu" id="submenu-dashboard" aria-hidden="true">
        <a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> <span>Início</span></a>
        <a href="#"><i class="fas fa-chart-line"></i> <span>Resumo</span></a>
      </div>
    </div>

    <div class="menu-item">
      <a href="javascript:void(0);" aria-expanded="false" aria-controls="submenu-users" role="button" tabindex="0">
        <i class="fas fa-users"></i>
        <span class="icon-only">Usuários</span>
        <i class="fas fa-chevron-down"></i>
      </a>
      <div class="submenu" id="submenu-users" aria-hidden="true">
        <a href="{{ route('users.index') }}"><i class="fas fa-list"></i> <span>Listar</span></a>
        <a href="{{ route('users.create') }}"><i class="fas fa-user-plus"></i> <span>Cadastrar</span></a>
      </div>
    </div>

    <a href="{{ route('user-groups.index') }}">
      <i class="fas fa-users-cog"></i>
      <span class="icon-only">Grupos</span>
    </a>

    <a href="{{ route('departments.index') }}">
      <i class="fas fa-building"></i>
      <span class="icon-only">Departamentos</span>
    </a>

    <div class="menu-item">
      <a href="javascript:void(0);" aria-expanded="false" aria-controls="submenu-tickets" role="button" tabindex="0">
        <i class="fas fa-ticket-alt"></i>
        <span class="icon-only">Chamados</span>
        <i class="fas fa-chevron-down"></i>
      </a>
      <div class="submenu" id="submenu-tickets" aria-hidden="true">
        <a href="{{ route('tickets.index') }}"><i class="fas fa-list-alt"></i> <span>Listar</span></a>
        <a href="{{ route('tickets.create') }}"><i class="fas fa-plus"></i> <span>Cadastrar</span></a>
        <a href="{{ route('ticket-statuses.index') }}"><i class="fas fa-toggle-on"></i> <span>Status</span></a>
        <a href="{{ route('ticket-priorities.index') }}"><i class="fas fa-exclamation-circle"></i> <span>Prioridades</span></a>
        <a href="{{ route('categories.index') }}"><i class="fas fa-tags"></i> <span>Categorias</span></a>
      </div>
    </div>

    <div class="menu-item">
      <a href="javascript:void(0);" aria-expanded="false" aria-controls="submenu-reports" role="button" tabindex="0">
        <i class="fas fa-chart-pie"></i>
        <span class="icon-only">Relatórios</span>
        <i class="fas fa-chevron-down"></i>
      </a>
      <div class="submenu" id="submenu-reports" aria-hidden="true">
        <a href="{{ route('reports.index') }}"><i class="fas fa-file-alt"></i> <span>Relatório de Chamados</span></a>
      </div>
    </div>

    <a href="{{ route('profile.index') }}">
      <i class="fas fa-user-circle"></i>
      <span class="icon-only">Perfil</span>
    </a>

    <form action="{{ route('logout') }}" method="POST" class="p-0">
      @csrf
      <button type="submit" class="text-white btn btn-link" style="background-color: transparent; border: none; width: 100%; text-align: left; padding-left: 12px;">
        <i class="fas fa-sign-out-alt"></i> <span class="icon-only">Sair</span>
      </button>
    </form>
  </div>
</div>

<!-- Conteúdo Principal -->
<div class="content" id="content">
  @yield('content')
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
  $(function() {
    // Toggle submenu ao clicar
    $('.menu-item > a').on('click', function () {
      const submenu = $(this).next('.submenu');
      const isExpanded = $(this).attr('aria-expanded') === 'true';

      // Fecha todos os outros submenus e remove rotação dos ícones
      $('.submenu').not(submenu).removeClass('show').attr('aria-hidden', 'true');
      $('.menu-item > a').not(this).attr('aria-expanded', 'false').find('i.fas.fa-chevron-down').removeClass('rotated');

      // Alterna o submenu clicado
      if (isExpanded) {
        submenu.removeClass('show').attr('aria-hidden', 'true');
        $(this).attr('aria-expanded', 'false');
        $(this).find('i.fas.fa-chevron-down').removeClass('rotated');
      } else {
        submenu.addClass('show').attr('aria-hidden', 'false');
        $(this).attr('aria-expanded', 'true');
        $(this).find('i.fas.fa-chevron-down').addClass('rotated');
      }
    });

    // Responsivo: botão toggle sidebar para mobile
    $('#toggleSidebar').on('click', function () {
      $('#sidebar').toggleClass('active');
    });
  });
</script>

</body>
</html>
