<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ticket_interactions', function (Blueprint $table) {
            $table->id();
            $table->text('text'); // Comentário da interação
            $table->dateTime('comment_date')->default(DB::raw('CURRENT_TIMESTAMP')); // Data da interação
            $table->unsignedBigInteger('interaction_type'); // Tipo da interação (possível referência a outra tabela)
            $table->string('file_type', 100)->nullable(); // Tipo de arquivo (se houver)
            $table->bigInteger('file_size')->nullable(); // Tamanho do arquivo (se houver)
            
            // Chaves estrangeiras
            $table->foreignId('fk_user_id')->constrained('users')->onDelete('restrict'); // Usuário que interage
            $table->foreignId('fk_ticket_id')->constrained('tickets')->onDelete('restrict'); // Ticket relacionado

            $table->timestamps(); // created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_interactions');
    }
};