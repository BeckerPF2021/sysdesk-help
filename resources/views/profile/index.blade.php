@extends('layouts.app')

@section('title', 'Perfil do Usuário')

@section('content')
@php
    // Define cores para status, similar ao que foi feito na página de tickets
    $statusColor = $user->active ? 'success' : 'danger'; // Usar danger para inativo pode ser mais visual
@endphp

<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-primary border-0 shadow-lg">
                <div class="card-body text-white py-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h1 class="display-6 fw-bold mb-2">
                                <i class="fas fa-user-circle me-3"></i>Perfil do Usuário
                            </h1>
                            <p class="lead mb-0 opacity-75">Visualize e edite suas informações pessoais</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('profile.edit') }}" class="btn btn-light btn-lg shadow-sm">
                                <i class="fas fa-edit me-2"></i>Editar Perfil
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Profile Card -->
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <img
                            src="{{ $user->profile_picture_url ?: 'https://via.placeholder.com/120/6c757d/ffffff?text=User' }}" {{-- Placeholder mais neutro --}}
                            alt="Foto de {{ $user->name }}"
                            class="rounded-circle shadow border border-light border-3"
                            width="120"
                            height="120"
                            style="object-fit: cover;"
                        />
                        <h3 class="mt-3 mb-1 fw-bold">{{ $user->name }}</h3>
                        <p class="mb-3 text-muted">{{ $user->role ?: 'Cargo não informado' }}</p>
                    </div>

                    <hr class="my-4">

                    <h5 class="mb-4 text-primary fw-bold"><i class="fas fa-info-circle me-2"></i>Informações Detalhadas</h5>

                    <div class="mb-3 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-envelope fa-fw text-primary me-3"></i>
                            <span class="fw-semibold">E-mail:</span>
                        </div>
                        <span class="text-muted">{{ $user->email }}</span>
                    </div>

                    <div class="mb-3 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-phone fa-fw text-success me-3"></i>
                            <span class="fw-semibold">Telefone:</span>
                        </div>
                        <span class="text-muted">{{ $user->phone ?: 'Não informado' }}</span>
                    </div>

                    <div class="mb-3 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-building fa-fw text-info me-3"></i>
                            <span class="fw-semibold">Departamento:</span>
                        </div>
                        <span class="text-muted">{{ $user->department ?: 'Não informado' }}</span>
                    </div>

                    <div class="mb-3 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-users fa-fw text-secondary me-3"></i>
                            <span class="fw-semibold">Grupo de Usuário:</span>
                        </div>
                        <span class="text-muted">{{ $user->userGroup->name ?? 'Não informado' }}</span>
                    </div>

                    <div class="mb-3 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                             <i class="fas {{ $user->active ? 'fa-check-circle' : 'fa-times-circle' }} fa-fw text-{{ $statusColor }} me-3"></i>
                            <span class="fw-semibold">Status:</span>
                        </div>
                        <span class="badge text-{{ $statusColor }} px-3 py-2" style="background-color: transparent; border: 1px solid currentColor;">
                            {{ $user->active ? 'Ativo' : 'Inativo' }}
                        </span>
                    </div>

                    <hr class="my-4">

                    <h5 class="mb-4 text-primary fw-bold"><i class="fas fa-history me-2"></i>Histórico</h5>

                    <div class="mb-3 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-calendar-plus fa-fw text-warning me-3"></i>
                            <span class="fw-semibold">Criado em:</span>
                        </div>
                        <span class="text-muted">{{ $user->created_at?->format('d/m/Y H:i') ?: '-' }}</span>
                    </div>

                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-calendar-check fa-fw text-primary me-3"></i>
                            <span class="fw-semibold">Última atualização:</span>
                        </div>
                        <span class="text-muted">{{ $user->updated_at?->format('d/m/Y H:i') ?: '-' }}</span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection