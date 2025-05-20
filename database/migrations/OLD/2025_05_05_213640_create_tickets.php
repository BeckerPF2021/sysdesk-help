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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('description');
            $table->timestamps();

            // Foreign Keys
            $table->foreignId('fk_user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('fk_category_id')->constrained('categories')->onDelete('restrict');
            $table->foreignId('fk_ticket_priority_id')->constrained('ticket_priorities')->onDelete('restrict');
            $table->foreignId('fk_ticket_status_id')->constrained('ticket_statuses')->onDelete('restrict');
            $table->foreignId('fk_department_id')->constrained('departments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};