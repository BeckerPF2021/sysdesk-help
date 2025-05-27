<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', config('app.name'))</title>

  <!-- Bootstrap 4.5.2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" />
  <!-- FontAwesome 5.15.3 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

  <style>
    /* Sidebar e layout */
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      height: 100vh;
      background-color: #f4f6f9;
      overflow-y: auto;
    }
    .sidebar {
      width: 60px;
      background-color: rgba(52, 58, 64, 0.95);
      color: white;
      position: fixed;
      top: 0;
      left: 0;
      bottom: 0;
      padding-top: 60px;
      transition: width 0.3s ease;
      overflow-y: auto;
      z-index: 1000;
      white-space: nowrap;
      display: flex;
      flex-direction: column;
    }
    .sidebar.expanded {
      width: 250px !important;
    }
    /* Ocultar textos quando sidebar estiver minimizada */
    .sidebar:not(.expanded) .user-info > *:not(.user-photo),
    .sidebar:not(.expanded) h4,
    .sidebar:not(.expanded) .menu-item > a span:not(.icon-only),
    .sidebar:not(.expanded) a span:not(.icon-only),
    .sidebar:not(.expanded) .submenu,
    .sidebar:not(.expanded) form button span {
      display: none !important;
    }
    .sidebar-header {
      position: fixed;
      top: 0;
      left: 0;
      height: 60px;
      width: 100%;
      background-color: rgba(33, 37, 41, 0.95);
      display: flex;
      align-items: center;
      padding: 0 10px;
      box-sizing: border-box;
      z-index: 1010;
      white-space: nowrap;
    }
    #toggleSidebar {
      background: none;
      border: none;
      color: white;
      font-size: 1.5rem;
      cursor: pointer;
      margin-right: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 36px;
      height: 36px;
      flex-shrink: 0;
    }
    .sidebar-header span.title {
      font-size: 1.25rem;
      font-weight: 700;
      user-select: none;
      color: white;
      flex-shrink: 1;
    }
    .user-info {
      display: flex;
      align-items: center;
      padding: 10px 15px 20px 15px;
      border-bottom: 1px solid rgba(255,255,255,0.1);
      cursor: default;
    }
    .user-photo {
      border-radius: 50%;
      width: 40px;
      height: 40px;
      object-fit: cover;
      flex-shrink: 0;
    }
    .user-name {
      margin-left: 10px;
      font-size: 0.95rem;
      font-weight: 600;
      white-space: nowrap;
      color: white;
      user-select: text;
    }
    .sidebar a,
    .sidebar .menu-item > a {
      color: white;
      text-decoration: none;
      padding: 12px 15px;
      display: flex;
      align-items: center;
      justify-content: flex-start;
      transition: background-color 0.3s ease;
      font-size: 0.95rem;
      cursor: pointer;
      position: relative;
      white-space: nowrap;
    }
    .sidebar a:hover,
    .sidebar .menu-item > a:hover {
      background-color: #495057;
    }
    .sidebar i.fas {
      margin-right: 0;
      width: 40px;
      text-align: center;
      transition: transform 0.3s ease;
      flex-shrink: 0;
      font-size: 1.3rem;
    }
    .sidebar span.icon-only {
      margin-left: 10px;
    }
    /* Esconder o chevron quando minimizado */
    .sidebar:not(.expanded) .menu-item > a i.fas.fa-chevron-down {
      display: none;
    }
    .sidebar.expanded .menu-item > a i.fas.fa-chevron-down {
      margin-left: auto;
      margin-right: 10px;
      transition: transform 0.3s ease;
    }
    .rotated {
      transform: rotate(180deg);
    }
    .submenu {
      display: none;
      flex-direction: column;
      padding-left: 10px;
      margin-left: 40px;
    }
    .sidebar.expanded .submenu.show {
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
    h4 {
      margin-left: 15px;
      margin-top: 10px;
      margin-bottom: 5px;
      font-weight: 600;
      color: white;
      white-space: nowrap;
    }
    .content {
      margin-left: 60px;
      flex: 1;
      padding: 20px;
      transition: margin-left 0.3s ease;
      overflow-y: auto;
      padding-top: 50px;
    }
    .sidebar.expanded ~ .content {
      margin-left: 250px;
    }
    @media (max-width: 768px) {
      .sidebar {
        left: -250px !important;
        width: 250px !important;
        transition: left 0.3s ease !important;
      }
      .sidebar.expanded {
        left: 0 !important;
      }
      .sidebar:not(.expanded) {
        left: -250px !important;
      }
      .content {
        margin-left: 0 !important;
        padding-top: 70px;
      }
      .sidebar.expanded ~ .content {
        margin-left: 250px !important;
      }
    }
  </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar" id="sidebar" role="navigation" aria-label="Menu lateral" tabindex="0">

  <div class="sidebar-header">
    <button id="toggleSidebar" aria-label="Alternar barra lateral">
      <i class="fas fa-bars"></i>
    </button>
    <span class="title">HelpDesk</span>
  </div>

  @auth
    @php
      $gravatarUrl = 'https://www.gravatar.com/avatar/' . md5(strtolower(trim(Auth::user()->email))) . '?d=mp&s=40';
    @endphp
    <div class="user-info" title="{{ Auth::user()->name }}">
      <img
        class="user-photo"
        src="{{ Auth::user()->profile_picture_url ?? $gravatarUrl }}"
        alt="Foto do usuário"
      />
      <span class="user-name">{{ Auth::user()->name }}</span>
    </div>
  @endauth

  <div class="d-flex flex-column flex-grow-1">

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
		<a href="{{ route('interaction-types.index') }}"><i class="fas fa-random"></i> <span>Tipos de Interação</span></a>
      </div>
    </div>

    <div class="menu-item">
      <a href="javascript:void(0);" aria-expanded="false" aria-controls="submenu-reports" role="button" tabindex="0">
        <i class="fas fa-chart-pie"></i>
        <span class="icon-only">Relatórios</span>
        <i class="fas fa-chevron-down"></i>
      </a>
      <div class="submenu" id="submenu-reports" aria-hidden="true">
        <a href="{{ route('reports.index') }}"><i class="fas fa-file-alt"></i> <span>Relat. de Chamados</span></a>
      </div>
    </div>

    <!-- Menu Configurações -->
    <div class="menu-item">
      <a href="javascript:void(0);" aria-expanded="false" aria-controls="submenu-settings" role="button" tabindex="0">
        <i class="fas fa-cogs"></i>
        <span class="icon-only">Configurações</span>
        <i class="fas fa-chevron-down"></i>
      </a>
      <div class="submenu" id="submenu-settings" aria-hidden="true">
        <a href="{{ route('users.index') }}"><i class="fas fa-users"></i> <span>Usuários</span></a>
        <a href="{{ route('user-groups.index') }}"><i class="fas fa-users-cog"></i> <span>Grupos</span></a>
        <a href="{{ route('departments.index') }}"><i class="fas fa-building"></i> <span>Departamentos</span></a>
      </div>
    </div>

    <a href="{{ route('profile.index') }}">
      <i class="fas fa-user"></i>
      <span class="icon-only">Perfil</span>
    </a>

    <form action="{{ route('logout') }}" method="POST" style="margin-top:auto;">
      @csrf
      <button type="submit" class="p-3 text-left text-white btn btn-link w-100" style="border:none; background:none; cursor:pointer;">
        <i class="fas fa-sign-out-alt"></i> <span class="icon-only">Sair</span>
      </button>
    </form>
  </div>
</div>

<div class="content">
  @yield('content')
</div>

<script>
  const sidebar = document.getElementById('sidebar');
  const toggleBtn = document.getElementById('toggleSidebar');

  toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('expanded');
  });

  // Submenu toggle
  document.querySelectorAll('.menu-item > a[aria-controls]').forEach(menuToggle => {
    menuToggle.addEventListener('click', e => {
      e.preventDefault();
      const submenuId = menuToggle.getAttribute('aria-controls');
      const submenu = document.getElementById(submenuId);
      const expanded = menuToggle.getAttribute('aria-expanded') === 'true';

      // Close all submenus
      document.querySelectorAll('.submenu').forEach(sm => sm.classList.remove('show'));
      document.querySelectorAll('.menu-item > a[aria-expanded]').forEach(link => {
        link.setAttribute('aria-expanded', 'false');
        link.querySelector('i.fas.fa-chevron-down').classList.remove('rotated');
      });

      if (!expanded) {
        submenu.classList.add('show');
        menuToggle.setAttribute('aria-expanded', 'true');
        menuToggle.querySelector('i.fas.fa-chevron-down').classList.add('rotated');
      }
    });

    menuToggle.addEventListener('keydown', e => {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        menuToggle.click();
      }
    });
  });
</script>

</body>
</html>
