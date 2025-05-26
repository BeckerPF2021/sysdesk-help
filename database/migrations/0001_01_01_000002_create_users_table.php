<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Cria as tabelas 'user_groups', 'users', 'password_reset_tokens' e 'sessions'.
     */
    public function up(): void
    {
        // Criando a tabela 'user_groups'
        Schema::create('user_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();      // Nome do grupo de usuários
            $table->text('description')->nullable();    // Descrição do grupo
            $table->timestamps();                       // created_at e updated_at
        });

        // Criando a tabela 'users'
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');                         // Nome do usuário
            $table->string('email')->unique();              // Email único
            $table->timestamp('email_verified_at')->nullable(); // Verificação de email
            $table->string('password');                     // Senha
            $table->rememberToken();                        // Token de "lembrar-me"
            
            // Novos campos baseados na view:
            $table->string('phone')->nullable();            // Telefone
            $table->string('role')->nullable();             // Cargo
            $table->string('department')->nullable();       // Departamento
            $table->string('profile_picture_url')->nullable(); // Foto de perfil
            $table->boolean('active')->default(true);       // Status
            $table->timestamp('last_login_at')->nullable(); // Último login

            // Relação com grupos
            $table->foreignId('user_group_id')->nullable()
                ->constrained('user_groups')
                ->onDelete('set null');

            $table->timestamps(); // created_at e updated_at
        });

        // Criando a tabela 'password_reset_tokens'
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();          // Email associado ao token
            $table->string('token');                     // Token de reset
            $table->timestamp('created_at')->nullable(); // Data de criação
        });

        // Criando a tabela 'sessions'
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();                 // ID da sessão
            $table->foreignId('user_id')->nullable()->index(); // FK usuário
            $table->string('ip_address', 45)->nullable();    // IP
            $table->text('user_agent')->nullable();          // Navegador
            $table->longText('payload');                     // Dados da sessão
            $table->integer('last_activity')->index();       // Última atividade
        });
    }

    /**
     * Reverse the migrations.
     *
     * Remove as tabelas criadas.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
        Schema::dropIfExists('user_groups');
    }
};
