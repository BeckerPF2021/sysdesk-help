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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['email', 'popup']); // Tipo de notificação
            $table->enum('status', ['pending', 'sent', 'error']); // Status da notificação
            $table->dateTime('date_time')->default(DB::raw('CURRENT_TIMESTAMP')); // Data e hora da notificação
            $table->foreignId('fk_ticket_interaction_id')->constrained('ticket_interactions')->onDelete('cascade'); // Interação relacionada
            $table->foreignId('fk_ticket_id')->constrained('tickets')->onDelete('cascade'); // Ticket relacionado
            $table->timestamps(); // created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};