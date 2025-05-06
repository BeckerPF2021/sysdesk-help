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
        Schema::create('ticket_histories', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_time')->default(DB::raw('CURRENT_TIMESTAMP')); // Data e hora da ação
            $table->text('action'); // Descrição da ação realizada
            $table->foreignId('fk_ticket_id')->constrained('tickets')->onDelete('restrict'); // Ticket relacionado
            $table->foreignId('fk_user_id')->constrained('users')->onDelete('restrict'); // Usuário que realizou a ação
            $table->timestamps(); // created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_histories');
    }
};