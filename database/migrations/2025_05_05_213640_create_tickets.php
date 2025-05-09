<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Cria a tabela 'tickets' com relacionamentos.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);               // Título do chamado
            $table->text('description');                // Descrição detalhada
            $table->timestamps();                       // Campos created_at e updated_at

            // Relacionamentos (chaves estrangeiras)
            $table->foreignId('fk_user_id')             // Usuário que abriu o chamado
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->foreignId('fk_category_id')         // Categoria do chamado
                  ->constrained('categories')
                  ->onDelete('restrict');

            $table->foreignId('fk_ticket_priority_id')  // Prioridade
                  ->constrained('ticket_priorities')
                  ->onDelete('restrict');

            $table->foreignId('fk_ticket_status_id')    // Status atual
                  ->constrained('ticket_statuses')
                  ->onDelete('restrict');

            $table->foreignId('fk_department_id')       // Departamento responsável
                  ->constrained('departments')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * Remove a tabela 'tickets'.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};