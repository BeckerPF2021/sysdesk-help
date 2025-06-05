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
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary-color: #6366f1;
      --primary-dark: #4f46e5;
      --secondary-color:rgb(255, 255, 255);
      --accent-color: #06b6d4;
      --success-color: #10b981;
      --warning-color: #f59e0b;
      --danger-color: #ef4444;
      --dark-bg: #1e293b;
      --dark-bg-light: #334155;
      --sidebar-bg: linear-gradient(135deg, #1e293b 0%, #334155 100%);
      --sidebar-hover: rgba(255, 255, 255, 0.1);
      --text-light: #f1f5f9;
      --text-muted:rgb(255, 255, 255);
      --border-light: rgba(255, 255, 255, 0.1);
      --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
      --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    body {
      margin: 0;
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      display: flex;
      height: 100vh;
      background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
      overflow-y: auto;
      font-weight: 400;
    }

    .sidebar {
      width: 70px;
      background: var(--sidebar-bg);
      color: var(--text-light);
      position: fixed;
      top: 0;
      left: 0;
      bottom: 0;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      overflow-x: hidden;
      overflow-y: auto;
      z-index: 1000;
      white-space: nowrap;
      display: flex;
      flex-direction: column;
      box-shadow: var(--shadow-lg);
      backdrop-filter: blur(10px);
      /* Configurações de scroll */
      scrollbar-width: thin;
      scrollbar-color: var(--border-light) transparent;
    }

    .sidebar.expanded {
      width: 280px !important;
    }

    .sidebar:not(.expanded) .user-info > *:not(.user-photo),
    .sidebar:not(.expanded) h4,
    .sidebar:not(.expanded) .menu-item > a span:not(.icon-only),
    .sidebar:not(.expanded) a span:not(.icon-only),
    .sidebar:not(.expanded) .submenu,
    .sidebar:not(.expanded) form button span,
    .sidebar:not(.expanded) .menu-badge {
      opacity: 0;
      visibility: hidden;
    }

    .sidebar-header {
      position: sticky;
      top: 0;
      height: 70px;
      width: 100%;
      background: linear-gradient(135deg, var(--dark-bg) 0%, var(--dark-bg-light) 100%);
      display: flex;
      align-items: center;
      padding: 0 20px;
      box-sizing: border-box;
      z-index: 1010;
      white-space: nowrap;
      border-bottom: 1px solid var(--border-light);
      backdrop-filter: blur(10px);
      flex-shrink: 0;
    }

    #toggleSidebar {
      background: none;
      border: none;
      color: var(--text-light);
      font-size: 1.4rem;
      cursor: pointer;
      margin-right: 15px;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      border-radius: 8px;
      transition: all 0.2s ease;
      flex-shrink: 0;
    }

    #toggleSidebar:hover {
      background-color: var(--sidebar-hover);
      transform: scale(1.05);
    }

    .sidebar-header .title {
      font-size: 1.5rem;
      font-weight: 700;
      user-select: none;
      color: var(--text-light);
      flex-shrink: 1;
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    /* Container scrollável do conteúdo */
    .sidebar-content {
      flex: 1;
      overflow-y: auto;
      overflow-x: hidden;
      padding-bottom: 20px;
      min-height: 0;
    }

    .user-info {
      display: flex;
      align-items: center;
      padding: 20px;
      border-bottom: 1px solid var(--border-light);
      cursor: default;
      margin-bottom: 10px;
      flex-shrink: 0;
    }

    .user-photo {
      border-radius: 12px;
      width: 45px;
      height: 45px;
      object-fit: cover;
      flex-shrink: 0;
      border: 2px solid var(--primary-color);
      box-shadow: var(--shadow);
    }

    .user-name {
      margin-left: 12px;
      font-size: 0.95rem;
      font-weight: 600;
      white-space: nowrap;
      color: var(--text-light);
      user-select: text;
      transition: all 0.3s ease;
    }

    .user-role {
      font-size: 0.75rem;
      color: var(--text-muted);
      font-weight: 400;
    }

    .sidebar a,
    .sidebar .menu-item > a {
      color: var(--text-light);
      text-decoration: none;
      padding: 12px 20px;
      display: flex;
      align-items: center;
      justify-content: flex-start;
      transition: all 0.2s ease;
      font-size: 0.9rem;
      font-weight: 500;
      cursor: pointer;
      position: relative;
      white-space: nowrap;
      border-radius: 0 25px 25px 0;
      margin: 2px 0;
      margin-right: 15px;
    }

    .sidebar a:hover,
    .sidebar .menu-item > a:hover {
      background: var(--sidebar-hover);
      color: white;
      transform: translateX(5px);
      box-shadow: var(--shadow);
    }

    .sidebar a.active {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      color: white;
      box-shadow: var(--shadow);
    }

    .sidebar i.fas {
      margin-right: 0;
      width: 20px;
      text-align: center;
      transition: all 0.3s ease;
      flex-shrink: 0;
      font-size: 1.1rem;
    }

    .sidebar span.icon-only {
      margin-left: 12px;
      transition: all 0.3s ease;
    }

    .sidebar:not(.expanded) .menu-item > a i.fas.fa-chevron-down {
      display: none;
    }

    .sidebar.expanded .menu-item > a i.fas.fa-chevron-down {
      margin-left: auto;
      margin-right: 5px;
      transition: transform 0.3s ease;
      font-size: 0.8rem;
    }

    .rotated {
      transform: rotate(180deg);
    }

    .submenu {
      display: none;
      flex-direction: column;
      padding-left: 0;
      margin-left: 45px;
      margin-right: 15px;
      border-left: 2px solid var(--border-light);
      margin-top: 5px;
      margin-bottom: 10px;
    }

    .sidebar.expanded .submenu.show {
      display: flex;
      animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .submenu a {
      font-size: 0.85rem;
      padding: 10px 15px;
      display: flex;
      align-items: center;
      color: var(--text-muted);
      transition: all 0.2s ease;
      cursor: pointer;
      white-space: nowrap;
      border-radius: 8px;
      margin: 1px 0;
      font-weight: 400;
    }

    .submenu a i {
      margin-right: 10px;
      width: 16px;
      text-align: center;
      font-size: 0.9rem;
    }

    .submenu a:hover {
      background-color: var(--sidebar-hover);
      color: var(--text-light);
      transform: translateX(3px);
    }

    .submenu a.active {
      background: linear-gradient(135deg, var(--accent-color), var(--success-color));
      color: white;
    }

    .menu-section {
      margin: 15px 0 10px 0;
      padding: 0 20px;
    }

    .menu-section h4 {
      font-size: 0.75rem;
      font-weight: 600;
      color: var(--text-muted);
      text-transform: uppercase;
      letter-spacing: 1px;
      margin: 0;
      padding: 5px 0;
      transition: all 0.3s ease;
    }

    .menu-badge {
      background: var(--danger-color);
      color: white;
      font-size: 0.7rem;
      padding: 2px 6px;
      border-radius: 10px;
      margin-left: auto;
      font-weight: 600;
      min-width: 18px;
      text-align: center;
      transition: all 0.3s ease;
    }

    .content {
      margin-left: 70px;
      flex: 1;
      padding: 30px;
      transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      overflow-y: auto;
      padding-top: 100px;
      background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
      min-height: 100vh;
    }

    .sidebar.expanded ~ .content {
      margin-left: 280px;
    }

    .logout-btn {
      margin-top: auto;
      margin-bottom: 20px;
      flex-shrink: 0;
      padding: 0 20px;
    }

    .logout-btn button {
      color: var(--text-muted) !important;
      border: none !important;
      background: none !important;
      cursor: pointer;
      width: 100%;
      text-align: left;
      padding: 12px 0 !important;
      font-size: 0.9rem;
      font-weight: 500;
      transition: all 0.2s ease;
      border-radius: 8px !important;
      display: flex;
      align-items: center;
    }

    .logout-btn button i {
      margin-right: 12px;
      width: 20px;
      text-align: center;
    }

    .logout-btn button:hover {
      background: rgba(239, 68, 68, 0.1) !important;
      color: var(--danger-color) !important;
      transform: translateX(5px);
    }

    /* Scrollbar personalizada aprimorada */
    .sidebar::-webkit-scrollbar {
      width: 6px;
    }

    .sidebar::-webkit-scrollbar-track {
      background: transparent;
      border-radius: 3px;
    }

    .sidebar::-webkit-scrollbar-thumb {
      background: var(--border-light);
      border-radius: 3px;
      transition: background 0.2s ease;
    }

    .sidebar::-webkit-scrollbar-thumb:hover {
      background: rgba(255, 255, 255, 0.3);
    }

    .sidebar-content::-webkit-scrollbar {
      width: 4px;
    }

    .sidebar-content::-webkit-scrollbar-track {
      background: transparent;
    }

    .sidebar-content::-webkit-scrollbar-thumb {
      background: var(--border-light);
      border-radius: 2px;
    }

    .sidebar-content::-webkit-scrollbar-thumb:hover {
      background: var(--text-muted);
    }

    /* Responsivo */
    @media (max-width: 768px) {
      .sidebar {
        left: -280px !important;
        width: 280px !important;
        transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
      }
      
      .sidebar.expanded {
        left: 0 !important;
      }
      
      .content {
        margin-left: 0 !important;
        padding: 20px;
        padding-top: 90px;
      }
      
      .sidebar.expanded ~ .content {
        margin-left: 0 !important;
      }
      
      /* Overlay para mobile */
      .sidebar.expanded::before {
        content: '';
        position: fixed;
        top: 0;
        right: -100vw;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.5);
        z-index: -1;
      }
    }

    /* Animações adicionais */
    .sidebar a,
    .submenu a {
      position: relative;
      overflow: hidden;
    }

    .sidebar a::before,
    .submenu a::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
      transition: left 0.5s;
    }

    .sidebar a:hover::before,
    .submenu a:hover::before {
      left: 100%;
    }

    /* Indicador de scroll suave */
    .sidebar-content {
      scroll-behavior: smooth;
    }

    /* Fade effect no topo e bottom quando há scroll */
    .sidebar::before {
      content: '';
      position: sticky;
      top: 70px;
      height: 10px;
      background: linear-gradient(to bottom, var(--dark-bg-light), transparent);
      z-index: 1;
      pointer-events: none;
    }

    .sidebar::after {
      content: '';
      position: sticky;
      bottom: 0;
      height: 10px;
      background: linear-gradient(to top, var(--dark-bg-light), transparent);
      z-index: 1;
      pointer-events: none;
      margin-top: -10px;
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
    <span class="title">SysDesk</span>
  </div>

  <div class="sidebar-content">
    @auth
      @php
        $gravatarUrl = 'https://www.gravatar.com/avatar/' . md5(strtolower(trim(Auth::user()->email))) . '?d=mp&s=45';
      @endphp
      <div class="user-info" title="{{ Auth::user()->name }}">
        <img
          class="user-photo"
          src="{{ Auth::user()->profile_picture_url ?? $gravatarUrl }}"
          alt="Foto do usuário"
        />
        <div>
          <div class="user-name">{{ Auth::user()->name }}</div>
          <div class="user-role">{{ Auth::user()->role ?? 'Usuário' }}</div>
        </div>
      </div>
    @endauth

    <div class="d-flex flex-column flex-grow-1">

      <div class="menu-section">
        <h4>Principal</h4>
      </div>

      <div class="menu-item">
        <a href="javascript:void(0);" aria-expanded="false" aria-controls="submenu-dashboard" role="button" tabindex="0">
          <i class="fas fa-tachometer-alt"></i>
          <span class="icon-only">Dashboard</span>
          <i class="fas fa-chevron-down"></i>
        </a>
        <div class="submenu" id="submenu-dashboard" aria-hidden="true">
          <a href="{{ route('dashboard') }}" class="active"><i class="fas fa-home"></i> <span>Início</span></a>
          <a href="#"><i class="fas fa-chart-line"></i> <span>Analytics</span></a>
          <a href="#"><i class="fas fa-bell"></i> <span>Notificações</span></a>
        </div>
      </div>

      <div class="menu-section">
        <h4>Gerenciamento</h4>
      </div>

      <div class="menu-item">
        <a href="javascript:void(0);" aria-expanded="false" aria-controls="submenu-users" role="button" tabindex="0">
          <i class="fas fa-users"></i>
          <span class="icon-only">Usuários</span>
          <span class="menu-badge">12</span>
          <i class="fas fa-chevron-down"></i>
        </a>
        <div class="submenu" id="submenu-users" aria-hidden="true">
          <a href="{{ route('users.index') }}"><i class="fas fa-list"></i> <span>Todos os Usuários</span></a>
          <a href="{{ route('users.create') }}"><i class="fas fa-user-plus"></i> <span>Novo Usuário</span></a>
          <a href="#"><i class="fas fa-user-shield"></i> <span>Permissões</span></a>
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

      <div class="menu-section">
        <h4>Suporte</h4>
      </div>

      <div class="menu-item">
        <a href="javascript:void(0);" aria-expanded="false" aria-controls="submenu-tickets" role="button" tabindex="0">
          <i class="fas fa-ticket-alt"></i>
          <span class="icon-only">Chamados</span>
          <span class="menu-badge">8</span>
          <i class="fas fa-chevron-down"></i>
        </a>
        <div class="submenu" id="submenu-tickets" aria-hidden="true">
          <a href="{{ route('tickets.index') }}"><i class="fas fa-list-alt"></i> <span>Todos os Chamados</span></a>
          <a href="{{ route('tickets.create') }}"><i class="fas fa-plus"></i> <span>Novo Chamado</span></a>
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
          <a href="{{ route('reports.index') }}"><i class="fas fa-file-alt"></i> <span>Relatórios de Chamados</span></a>
          <a href="#"><i class="fas fa-chart-bar"></i> <span>Performance</span></a>
          <a href="#"><i class="fas fa-download"></i> <span>Exportar Dados</span></a>
        </div>
      </div>

      <div class="menu-section">
        <h4>Sistema</h4>
      </div>

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
          <a href="#"><i class="fas fa-palette"></i> <span>Aparência</span></a>
        </div>
      </div>

      <a href="{{ route('profile.index') }}">
        <i class="fas fa-user-circle"></i>
        <span class="icon-only">Meu Perfil</span>
      </a>
    </div>
  </div>

  <div class="logout-btn">
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button type="submit">
        <i class="fas fa-sign-out-alt"></i> <span>Sair</span>
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

  // Toggle sidebar
  toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('expanded');
    
    // Armazenar preferência do usuário
    localStorage.setItem('sidebarExpanded', sidebar.classList.contains('expanded'));
  });

  // Restaurar estado da sidebar
  if (localStorage.getItem('sidebarExpanded') === 'true') {
    sidebar.classList.add('expanded');
  }

  // Submenu toggle com melhor UX
  document.querySelectorAll('.menu-item > a[aria-controls]').forEach(menuToggle => {
    menuToggle.addEventListener('click', e => {
      e.preventDefault();
      const submenuId = menuToggle.getAttribute('aria-controls');
      const submenu = document.getElementById(submenuId);
      const expanded = menuToggle.getAttribute('aria-expanded') === 'true';
      const chevron = menuToggle.querySelector('i.fas.fa-chevron-down');

      // Fechar outros submenus
      document.querySelectorAll('.submenu').forEach(sm => {
        if (sm !== submenu) {
          sm.classList.remove('show');
        }
      });
      
      document.querySelectorAll('.menu-item > a[aria-expanded]').forEach(link => {
        if (link !== menuToggle) {
          link.setAttribute('aria-expanded', 'false');
          link.querySelector('i.fas.fa-chevron-down').classList.remove('rotated');
        }
      });

      // Toggle submenu atual
      if (!expanded) {
        submenu.classList.add('show');
        menuToggle.setAttribute('aria-expanded', 'true');
        chevron.classList.add('rotated');
        
        // Expandir sidebar se necessário
        if (!sidebar.classList.contains('expanded')) {
          sidebar.classList.add('expanded');
          localStorage.setItem('sidebarExpanded', 'true');
        }
      } else {
        submenu.classList.remove('show');
        menuToggle.setAttribute('aria-expanded', 'false');
        chevron.classList.remove('rotated');
      }
    });

    // Suporte a teclado
    menuToggle.addEventListener('keydown', e => {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        menuToggle.click();
      }
    });
  });

  // Fechar sidebar no mobile ao clicar fora
  document.addEventListener('click', (e) => {
    if (window.innerWidth <= 768 && 
        sidebar.classList.contains('expanded') && 
        !sidebar.contains(e.target)) {
      sidebar.classList.remove('expanded');
    }
  });

  // Smooth hover effects
  document.querySelectorAll('.sidebar a, .submenu a').forEach(link => {
    link.addEventListener('mouseenter', function() {
      this.style.transform = 'translateX(5px)';
    });
    
    link.addEventListener('mouseleave', function() {
      this.style.transform = 'translateX(0)';
    });
  });
</script>

</body>
</html>