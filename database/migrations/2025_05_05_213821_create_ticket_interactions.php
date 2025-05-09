<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Cria a tabela 'ticket_interactions' para armazenar interações em tickets.
     */
    public function up(): void
    {
        Schema::create('ticket_interactions', function (Blueprint $table) {
            $table->id();
            $table->text('text');                        // Texto da interação
            $table->dateTime('comment_date')->default(DB::raw('CURRENT_TIMESTAMP'));  // Data da interação
            $table->unsignedBigInteger('interaction_type');  // Tipo de interação (referência a outra tabela)
            $table->string('file_type', 100)->nullable();      // Tipo de arquivo (se houver)
            $table->bigInteger('file_size')->nullable();      // Tamanho do arquivo (se houver)
            
            // Chaves estrangeiras
            $table->foreignId('fk_user_id')                 // Usuário que fez a interação
                  ->constrained('users')
                  ->onDelete('restrict');

            $table->foreignId('fk_ticket_id')               // Ticket relacionado
                  ->constrained('tickets')
                  ->onDelete('restrict');

            $table->timestamps();                           // created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * Remove a tabela 'ticket_interactions'.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_interactions');
    }
};