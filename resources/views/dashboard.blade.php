@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-gradient-primary border-0 shadow-lg">
                <div class="card-body text-white text-center py-5">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <div class="welcome-icon">
                                <i class="fas fa-tachometer-alt fa-4x opacity-75"></i>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h1 class="display-4 fw-bold mb-2">Olá, {{ Auth::user()->name }}!</h1>
                            <p class="lead mb-3">Bem-vindo ao SYSDESK - Sistema de Gerenciamento de Tickets</p>
                            <div class="badge bg-light text-primary px-3 py-2 fs-6">
                                <i class="fas fa-user me-2"></i>
                                {{ Auth::user()->username ?? Auth::user()->email }}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center">
                                <div class="time-display">
                                    <i class="fas fa-calendar-check fa-2x mb-2"></i>
                                    <p class="small mb-1">{{ now()->format('d/m/Y') }}</p>
                                    <p class="small mb-0">
                                        <i class="fas fa-clock me-1"></i>
                                        {{ now()->format('H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
        $group = Auth::user()->user_group_id;
        $groupNames = [
            1 => 'Administrador',
            2 => 'Agente',
            3 => 'Usuário'
        ];
        $groupColors = [
            1 => 'primary',
            2 => 'warning', 
            3 => 'success'
        ];
        $groupIcons = [
            1 => 'fas fa-crown',
            2 => 'fas fa-headset',
            3 => 'fas fa-user-circle'
        ];
    @endphp

    <!-- Role Badge -->
    <div class="row mb-4">
        <div class="col-12 text-center">
                <span class="badge bg-{{ $groupColors[$group] ?? 'secondary' }} px-4 py-2 fs-5 role-badge">
                <i class="{{ $groupIcons[$group] ?? 'fas fa-question-circle' }} me-2"></i>
                {{ $groupNames[$group] ?? 'Perfil Desconhecido' }}
            </span>
        </div>
    </div>

    @switch($group)
        @case(1) {{-- Administrador --}}
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <div class="section-header">
                        <i class="fas fa-cogs fa-2x mb-3"></i> <!-- Removido 'text-primary' -->
                        <h3 class="mb-3">Painel de Administração</h3>
                        <p class="text-muted mb-4">
                            Você tem acesso completo ao sistema. Gerencie todos os aspectos do SYSDESK.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                @foreach ([
                    ['route' => 'users.index', 'label' => 'Gerenciar Usuários', 'color' => 'primary', 'icon' => 'fas fa-users', 'desc' => 'Adicionar, editar e remover usuários'],
                    ['route' => 'user-groups.index', 'label' => 'Gerenciar Grupos', 'color' => 'primary', 'icon' => 'fas fa-users-cog', 'desc' => 'Configurar grupos e permissões'],
                    ['route' => 'departments.index', 'label' => 'Gerenciar Departamentos', 'color' => 'primary', 'icon' => 'fas fa-building', 'desc' => 'Organizar estrutura departamental'],
                    ['route' => 'categories.index', 'label' => 'Gerenciar Categorias', 'color' => 'primary', 'icon' => 'fas fa-tags', 'desc' => 'Classificar tipos de tickets'],
                    ['route' => 'ticket-statuses.index', 'label' => 'Status de Tickets', 'color' => 'primary', 'icon' => 'fas fa-clipboard-list', 'desc' => 'Configurar estados dos tickets'],
                    ['route' => 'ticket-priorities.index', 'label' => 'Prioridades', 'color' => 'primary', 'icon' => 'fas fa-exclamation-circle', 'desc' => 'Definir níveis de urgência'],
                    ['route' => 'reports.index', 'label' => 'Relatórios', 'color' => 'info', 'icon' => 'fas fa-chart-line', 'desc' => 'Analytics e métricas do sistema'],
                    ['route' => 'profile.index', 'label' => 'Meu Perfil', 'color' => 'secondary', 'icon' => 'fas fa-user-cog', 'desc' => 'Configurações da conta']
                ] as $card)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <a href="{{ route($card['route']) }}" class="text-decoration-none">
                            <div class="card border-0 shadow-sm h-100 card-hover">
                                <div class="card-body text-center p-4">
                                    <div class="icon-container bg-{{ $card['color'] }} mb-3">
                                        <i class="{{ $card['icon'] }} fa-2x text-white"></i>
                                    </div>
                                    <h6 class="card-title fw-bold text-{{ $card['color'] }} mb-2">{{ $card['label'] }}</h6>
                                    <p class="card-text text-muted small">{{ $card['desc'] }}</p>
                                </div>
                                <div class="card-footer bg-transparent border-0 text-center">
                                    <small class="text-{{ $card['color'] }} fw-semibold">
                                        <i class="fas fa-arrow-right me-1"></i>Acessar
                                    </small>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            @break

        @case(2) {{-- Agente --}}
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <div class="section-header">
                        <i class="fas fa-headset fa-2x text-warning mb-3"></i>
                        <h3 class="mb-3">Painel do Agente</h3>
                        <p class="text-muted mb-4">Gerencie tickets e acompanhe o atendimento aos usuários.</p>
                    </div>
                </div>
            </div>
            
            <div class="row g-4 justify-content-center">
                @foreach ([
                    ['route' => 'tickets.index', 'label' => 'Gerenciar Tickets', 'color' => 'warning', 'icon' => 'fas fa-ticket-alt', 'desc' => 'Atender e resolver tickets'],
                    ['route' => 'reports.index', 'label' => 'Relatórios', 'color' => 'info', 'icon' => 'fas fa-chart-bar', 'desc' => 'Acompanhar métricas de atendimento'],
                    ['route' => 'profile.index', 'label' => 'Meu Perfil', 'color' => 'secondary', 'icon' => 'fas fa-user', 'desc' => 'Configurações pessoais']
                ] as $card)
                    <div class="col-lg-4 col-md-6">
                        <a href="{{ route($card['route']) }}" class="text-decoration-none">
                            <div class="card border-0 shadow-sm h-100 card-hover">
                                <div class="card-body text-center p-4">
                                    <div class="icon-container-large bg-{{ $card['color'] }} mb-3">
                                        <i class="{{ $card['icon'] }} fa-3x text-white"></i>
                                    </div>
                                    <h5 class="card-title fw-bold text-{{ $card['color'] }} mb-2">{{ $card['label'] }}</h5>
                                    <p class="card-text text-muted">{{ $card['desc'] }}</p>
                                </div>
                                <div class="card-footer bg-transparent border-0 text-center">
                                    <small class="text-{{ $card['color'] }} fw-semibold">
                                        <i class="fas fa-arrow-right me-1"></i>Acessar
                                    </small>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            @break

        @case(3) {{-- Usuário Normal --}}
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <div class="section-header">
                        <i class="fas fa-user-circle fa-2x text-success mb-3"></i>
                        <h3 class="mb-3">Painel do Usuário</h3>
                        <p class="text-muted mb-4">Abra tickets, acompanhe suas solicitações e gerencie seu perfil.</p>
                    </div>
                </div>
            </div>
            
            <div class="row g-4 justify-content-center">
                @foreach ([
                    ['route' => 'tickets.index', 'label' => 'Meus Tickets', 'color' => 'success', 'icon' => 'fas fa-ticket-alt', 'desc' => 'Acompanhar suas solicitações'],
                    ['route' => 'tickets.create', 'label' => 'Novo Ticket', 'color' => 'success', 'icon' => 'fas fa-plus-circle', 'desc' => 'Abrir nova solicitação'],
                    ['route' => 'profile.index', 'label' => 'Meu Perfil', 'color' => 'secondary', 'icon' => 'fas fa-user', 'desc' => 'Configurações pessoais']
                ] as $card)
                    <div class="col-lg-4 col-md-6">
                        <a href="{{ route($card['route']) }}" class="text-decoration-none">
                            <div class="card border-0 shadow-sm h-100 card-hover">
                                <div class="card-body text-center p-4">
                                    <div class="icon-container-large bg-{{ $card['color'] }} mb-3">
                                        <i class="{{ $card['icon'] }} fa-3x text-white"></i>
                                    </div>
                                    <h5 class="card-title fw-bold text-{{ $card['color'] }} mb-2">{{ $card['label'] }}</h5>
                                    <p class="card-text text-muted">{{ $card['desc'] }}</p>
                                </div>
                                <div class="card-footer bg-transparent border-0 text-center">
                                    <small class="text-{{ $card['color'] }} fw-semibold">
                                        <i class="fas fa-arrow-right me-1"></i>Acessar
                                    </small>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            @break

        @default
            <div class="row">
                <div class="col-12">
                    <div class="card border-danger shadow-sm">
                        <div class="card-body text-center py-5">
                            <div class="error-icon mb-3">
                                <i class="fas fa-exclamation-triangle fa-4x text-danger"></i>
                            </div>
                            <h4 class="text-danger mb-3">Perfil Não Reconhecido</h4>
                            <p class="text-muted mb-4">Seu perfil de usuário não foi identificado corretamente no sistema.</p>
                            <div class="alert alert-warning">
                                <i class="fas fa-info-circle me-2"></i>
                                <strong>O que fazer:</strong> Entre em contato com o administrador do sistema para resolver este problema.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endswitch

    <!-- Help Section -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card bg-light border-0 shadow-sm">
                <div class="card-body text-center py-4">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <div class="help-icon">
                                <i class="fas fa-life-ring fa-3x text-info"></i>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h5 class="mb-2">
                                <i class="fas fa-question-circle me-2 text-info"></i>
                                Precisa de Ajuda?
                            </h5>
                            <p class="text-muted mb-0">
                                Consulte nosso manual do sistema ou entre em contato com o suporte técnico para esclarecimentos.
                            </p>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-outline-info btn-help" onclick="alert('Em breve: Manual do Sistema')">
                                <i class="fas fa-book me-2"></i>Manual
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card-hover {
    transition: all 0.3s ease;
    border-radius: 12px;
}

.card-hover:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.15) !important;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
}

.icon-container {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.icon-container-large {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 6px 16px rgba(0,0,0,0.15);
}

.role-badge {
    border-radius: 25px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.section-header {
    margin-bottom: 2rem;
}

.welcome-icon {
    animation: pulse 2s infinite;
}

.time-display {
    background: rgba(255,255,255,0.1);
    border-radius: 12px;
    padding: 1rem;
    backdrop-filter: blur(10px);
}

.help-icon {
    animation: bounce 2s infinite;
}

.btn-help {
    border-radius: 25px;
    padding: 0.5rem 1.5rem;
    transition: all 0.3s ease;
}

.btn-help:hover {
    transform: scale(1.05);
}

.error-icon {
    animation: shake 0.5s;
    animation-iteration-count: 3;
}

@keyframes pulse {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
    100% {
        transform: scale(1);
    }
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-10px);
    }
    60% {
        transform: translateY(-5px);
    }
}

@keyframes shake {
    0% { transform: translate(1px, 1px) rotate(0deg); }
    10% { transform: translate(-1px, -2px) rotate(-1deg); }
    20% { transform: translate(-3px, 0px) rotate(1deg); }
    30% { transform: translate(3px, 2px) rotate(0deg); }
    40% { transform: translate(1px, -1px) rotate(1deg); }
    50% { transform: translate(-1px, 2px) rotate(-1deg); }
    60% { transform: translate(-3px, 1px) rotate(0deg); }
    70% { transform: translate(3px, 1px) rotate(-1deg); }
    80% { transform: translate(-1px, -1px) rotate(1deg); }
    90% { transform: translate(1px, 2px) rotate(0deg); }
    100% { transform: translate(1px, -2px) rotate(-1deg); }
}

/* Responsividade */
@media (max-width: 768px) {
    .icon-container {
        width: 50px;
        height: 50px;
    }
    
    .icon-container-large {
        width: 70px;
        height: 70px;
    }
    
    .display-4 {
        font-size: 2rem !important;
    }
    
    .lead {
        font-size: 1rem !important;
    }
}
</style>
@endsection