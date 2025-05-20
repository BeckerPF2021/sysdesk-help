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
use App\Http\Controllers\TicketInteractionController;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard - exige autenticação e verificação de email
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rotas que precisam estar autenticadas
Route::middleware('auth')->group(function () {

    // Visualizar perfil (exibir dados)
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

    // Editar perfil (formulário)
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    // Atualizar perfil
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Excluir perfil
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUDs de recursos
    Route::resource('user-groups', UserGroupController::class);
    Route::resource('users', UserController::class)->except(['show']);
    Route::resource('departments', DepartmentController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('ticket-statuses', TicketStatusController::class);
    Route::resource('ticket-priorities', TicketPriorityController::class);
    Route::resource('tickets', TicketController::class); // inclui o método show também

    // Rotas para interações de tickets, agrupadas por ticket
    Route::prefix('tickets/{ticket}')->name('ticket_interactions.')->group(function () {
        Route::get('interactions', [TicketInteractionController::class, 'index'])->name('index');
        Route::get('interactions/create', [TicketInteractionController::class, 'create'])->name('create');
        Route::post('interactions', [TicketInteractionController::class, 'store'])->name('store');
        Route::get('interactions/{ticketInteraction}', [TicketInteractionController::class, 'show'])->name('show');
        Route::get('interactions/{ticketInteraction}/edit', [TicketInteractionController::class, 'edit'])->name('edit');
        Route::put('interactions/{ticketInteraction}', [TicketInteractionController::class, 'update'])->name('update');
        Route::delete('interactions/{ticketInteraction}', [TicketInteractionController::class, 'destroy'])->name('destroy');
    });

});

require __DIR__.'/auth.php';