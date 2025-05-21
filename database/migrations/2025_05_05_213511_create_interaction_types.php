<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Cria a tabela 'interaction_types' com nome único.
     */
    public function up(): void
    {
        Schema::create('interaction_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique(); // Exemplo: Comentário, Atualização de Status, Anexo
            $table->timestamps(); // Campos created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * Remove a tabela 'interaction_types' do banco de dados.
     */
    public function down(): void
    {
        Schema::dropIfExists('interaction_types');
    }
};