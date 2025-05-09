<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Cria a tabela 'ticket_priorities' com nome único.
     */
    public function up(): void
    {
        Schema::create('ticket_priorities', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique(); // Nome da prioridade (ex: Alta, Média, Baixa)
            $table->timestamps(); // Campos created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * Remove a tabela 'ticket_priorities' do banco de dados.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_priorities');
    }
};
