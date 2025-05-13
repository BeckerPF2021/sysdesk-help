<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Cria a tabela 'ticket_statuses' com nome único.
     */
    public function up(): void
    {
        Schema::create('ticket_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique(); // Nome do status (ex: Aberto, Fechado, Em andamento)
            $table->timestamps(); // Campos created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * Remove a tabela 'ticket_statuses' do banco de dados.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_statuses');
    }
};