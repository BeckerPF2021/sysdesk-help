@extends('layouts.app')

@section('title', 'Menu Geral')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-primary font-weight-bold">Menu Geral</h1>

    @foreach($menus as $menu)
        <div class="card mb-4 shadow-sm rounded-lg border-0">
            <div class="card-header bg-gradient-primary text-white d-flex align-items-center" style="background: linear-gradient(90deg, #0d6efd, #6610f2);">
                <h2 class="h5 mb-0 flex-grow-1">{{ $menu['title'] }}</h2>
                <i class="fas fa-folder-open ml-2"></i>
            </div>
            @if (!empty($menu['submenus']))
            <ul class="list-group list-group-flush">
                @foreach($menu['submenus'] as $submenu)
                    <li class="list-group-item d-flex justify-content-between align-items-center hover-shadow" style="transition: background-color 0.2s ease;">
                        <a href="{{ route($submenu['route_name']) }}" class="text-decoration-none text-dark font-weight-medium">
                            <i class="fas fa-link mr-2 text-primary"></i>
                            {{ $submenu['title'] }}
                        </a>
                        <span class="badge badge-pill badge-light border text-primary font-weight-bold">
                            {{ strtoupper(implode(',', $submenu['methods'])) }}
                        </span>
                    </li>
                @endforeach
            </ul>
            @else
                <div class="card-body text-muted fst-italic">
                    Nenhum submenu disponível
                </div>
            @endif
        </div>
    @endforeach
</div>

<style>
    /* Efeito hover no item do submenu */
    .hover-shadow:hover {
        background-color: #f8f9fa;
        cursor: pointer;
    }
</style>
@endsection
