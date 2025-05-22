<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Cria a tabela 'departments' com um nome único.
     */
    public function up(): void
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique(); // Nome do departamento (único)
            $table->timestamps(); // Campos created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * Exclui a tabela 'departments'.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};