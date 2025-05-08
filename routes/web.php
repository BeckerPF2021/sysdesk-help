<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserGroupController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TicketStatusController;
use App\Http\Controllers\TicketPriorityController;
use App\Http\Controllers\TicketController;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rotas autenticadas
Route::middleware('auth')->group(function () {
    // Perfil do usuário
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD de Grupos de Usuários
    Route::resource('user-groups', UserGroupController::class);

    // CRUD de Usuários
    Route::resource('users', UserController::class)->except(['show']);

    // CRUD de Departamentos
    Route::resource('departments', DepartmentController::class);

    // CRUD de Categorias
    Route::resource('categories', CategoryController::class);

    // CRUD de Status de Tickets
    Route::resource('ticket-statuses', TicketStatusController::class);

    // CRUD de Prioridades de Tickets
    Route::resource('ticket-priorities', TicketPriorityController::class);

    // CRUD do Ticket
    Route::resource('tickets', TicketController::class);
});

require __DIR__.'/auth.php';
