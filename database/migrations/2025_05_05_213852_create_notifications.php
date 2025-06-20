<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Cria a tabela 'notifications' para armazenar as notificações dos tickets.
     */
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['email', 'popup']);             // Tipo de notificação (email ou popup)
            $table->enum('status', ['pending', 'sent', 'error']); // Status da notificação
            $table->dateTime('date_time')->default(DB::raw('CURRENT_TIMESTAMP')); // Data e hora da notificação
            $table->foreignId('fk_ticket_interaction_id')        // Interação relacionada
                  ->constrained('ticket_interactions')
                  ->onDelete('cascade');
            $table->foreignId('fk_ticket_id')                     // Ticket relacionado
                  ->constrained('tickets')
                  ->onDelete('cascade');
            $table->timestamps();                                 // created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * Remove a tabela 'notifications'.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};