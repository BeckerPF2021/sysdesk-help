<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Cria a tabela 'ticket_interactions' para armazenar interações de tickets.
     */
    public function up(): void
    {
        Schema::create('ticket_interactions', function (Blueprint $table) {
            $table->id();

            $table->text('text'); // Texto da interação
            $table->dateTime('comment_date')->default(DB::raw('CURRENT_TIMESTAMP')); // Data da interação

            // Relação com interaction_types
            $table->foreignId('interaction_type')
                  ->constrained('interaction_types')
                  ->onDelete('restrict');

            $table->string('file_type', 100)->nullable(); // Tipo de arquivo
            $table->unsignedBigInteger('file_size')->nullable(); // Tamanho do arquivo

            // Relação com users
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('restrict');

            // Relação com tickets
            $table->foreignId('ticket_id')
                  ->constrained('tickets')
                  ->onDelete('restrict');

            $table->timestamps();

            // Índices para otimização de busca
            $table->index(['user_id', 'ticket_id', 'interaction_type']);
        });
    }

    /**
     * Remove a tabela 'ticket_interactions'.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_interactions');
    }
};
