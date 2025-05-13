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

    // CRUDs
    Route::resource('user-groups', UserGroupController::class);
    Route::resource('users', UserController::class)->except(['show']);
    Route::resource('departments', DepartmentController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('ticket-statuses', TicketStatusController::class);
    Route::resource('ticket-priorities', TicketPriorityController::class);
    Route::resource('tickets', TicketController::class); // Inclui 'show' também

    // Rotas de Interações por Ticket
    Route::prefix('tickets/{ticket}')->name('ticket_interactions.')->group(function () {
        Route::get('interactions', [TicketInteractionController::class, 'index'])->name('index'); // Listar interações do ticket
        Route::get('interactions/create', [TicketInteractionController::class, 'create'])->name('create'); // Formulário de criação de interação
        Route::post('interactions', [TicketInteractionController::class, 'store'])->name('store'); // Armazenar interação
        Route::get('interactions/{ticketInteraction}', [TicketInteractionController::class, 'show'])->name('show'); // Mostrar interação
        Route::get('interactions/{ticketInteraction}/edit', [TicketInteractionController::class, 'edit'])->name('edit'); // Editar interação
        Route::put('interactions/{ticketInteraction}', [TicketInteractionController::class, 'update'])->name('update'); // Atualizar interação
        Route::delete('interactions/{ticketInteraction}', [TicketInteractionController::class, 'destroy'])->name('destroy'); // Deletar interação
    });

});

require __DIR__.'/auth.php';