@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-4">
    <div class="mb-4 text-center">
        <h1 class="display-4">Olá, {{ Auth::user()->name }}!</h1>
        <p class="lead">Bem-vindo ao SYSDESK.</p>
        <hr class="my-4">
        <p>Seu usuário: <strong>{{ Auth::user()->username ?? Auth::user()->email }}</strong></p>
    </div>

    @php
        $group = Auth::user()->user_group_id;
    @endphp

    @switch($group)
        @case(1) {{-- Administrador --}}
            <h3 class="mb-3 text-center">Você tem acesso completo ao sistema. Algumas ações que você pode realizar:</h3>
            <div class="row justify-content-center">
                @foreach ([
                    ['route' => 'users.index', 'label' => 'Gerenciar Usuários', 'color' => 'primary', 'icon' => 'fas fa-users'],
                    ['route' => 'user-groups.index', 'label' => 'Gerenciar Grupos', 'color' => 'primary', 'icon' => 'fas fa-users-cog'],
                    ['route' => 'departments.index', 'label' => 'Gerenciar Departamentos', 'color' => 'primary', 'icon' => 'fas fa-building'],
                    ['route' => 'categories.index', 'label' => 'Gerenciar Categorias', 'color' => 'primary', 'icon' => 'fas fa-tags'],
                    ['route' => 'ticket-statuses.index', 'label' => 'Gerenciar Status de Ticket', 'color' => 'primary', 'icon' => 'fas fa-clipboard-list'],
                    ['route' => 'ticket-priorities.index', 'label' => 'Gerenciar Prioridades', 'color' => 'primary', 'icon' => 'fas fa-exclamation-circle'],
                    ['route' => 'reports.index', 'label' => 'Acompanhar Relatórios', 'color' => 'primary', 'icon' => 'fas fa-chart-line'],
                    ['route' => 'profile.index', 'label' => 'Ver Perfil', 'color' => 'secondary', 'icon' => 'fas fa-user']
                ] as $card)
                    <div class="mb-3 col-md-4">
                        <a href="{{ route($card['route']) }}" class="text-decoration-none">
                            <div class="card border-{{ $card['color'] }} shadow-sm h-100">
                                <div class="card-body d-flex align-items-center">
                                    <i class="{{ $card['icon'] }} fa-2x text-{{ $card['color'] }} mr-3"></i>
                                    <span class="font-weight-bold text-{{ $card['color'] }}">{{ $card['label'] }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            @break

        @case(2) {{-- Agente --}}
            <h3 class="mb-3 text-center">Suas principais funções neste sistema são:</h3>
            <div class="row justify-content-center">
                @foreach ([
                    ['route' => 'tickets.index', 'label' => 'Gerenciar Tickets', 'color' => 'warning', 'icon' => 'fas fa-ticket-alt'],
                    ['route' => 'reports.index', 'label' => 'Acompanhar Relatórios', 'color' => 'warning', 'icon' => 'fas fa-chart-bar'],
                    ['route' => 'profile.index', 'label' => 'Ver Perfil', 'color' => 'secondary', 'icon' => 'fas fa-user']
                ] as $card)
                    <div class="mb-3 col-md-4">
                        <a href="{{ route($card['route']) }}" class="text-decoration-none">
                            <div class="card border-{{ $card['color'] }} shadow-sm h-100">
                                <div class="card-body d-flex align-items-center">
                                    <i class="{{ $card['icon'] }} fa-2x text-{{ $card['color'] }} mr-3"></i>
                                    <span class="font-weight-bold text-{{ $card['color'] }}">{{ $card['label'] }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            @break

        @case(3) {{-- Usuário Normal --}}
            <h3 class="mb-3 text-center">Algumas ações úteis para você:</h3>
            <div class="row justify-content-center">
                @foreach ([
                    ['route' => 'tickets.index', 'label' => 'Meus Tickets', 'color' => 'success', 'icon' => 'fas fa-ticket-alt'],
                    ['route' => 'tickets.create', 'label' => 'Abrir Novo Ticket', 'color' => 'success', 'icon' => 'fas fa-plus-circle'],
                    ['route' => 'profile.index', 'label' => 'Ver Perfil', 'color' => 'secondary', 'icon' => 'fas fa-user']
                ] as $card)
                    <div class="mb-3 col-md-4">
                        <a href="{{ route($card['route']) }}" class="text-decoration-none">
                            <div class="card border-{{ $card['color'] }} shadow-sm h-100">
                                <div class="card-body d-flex align-items-center">
                                    <i class="{{ $card['icon'] }} fa-2x text-{{ $card['color'] }} mr-3"></i>
                                    <span class="font-weight-bold text-{{ $card['color'] }}">{{ $card['label'] }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            @break

        @default
            <h4 class="mb-3 text-center text-danger">Perfil desconhecido</h4>
            <p class="text-center">Por favor, entre em contato com o administrador do sistema para resolver este problema.</p>
    @endswitch

    <div class="mt-4 row justify-content-center">
        <div class="text-center col-md-8">
            <p class="text-muted">Se precisar de ajuda, consulte o manual do sistema ou fale com o suporte.</p>
        </div>
    </div>
</div>
@endsection
