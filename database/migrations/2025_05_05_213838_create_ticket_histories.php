<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Cria a tabela 'ticket_histories' para armazenar o histórico de ações nos tickets.
     */
    public function up(): void
    {
        Schema::create('ticket_histories', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_time')->default(DB::raw('CURRENT_TIMESTAMP')); // Data e hora da ação
            $table->text('action'); // Descrição da ação realizada
            $table->foreignId('fk_ticket_id')                     // Ticket relacionado
                  ->constrained('tickets')
                  ->onDelete('restrict');
            $table->foreignId('fk_user_id')                        // Usuário que realizou a ação
                  ->constrained('users')
                  ->onDelete('restrict');
            $table->timestamps();                                  // created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * Remove a tabela 'ticket_histories'.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_histories');
    }
};