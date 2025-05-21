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
            $table->string('name', 100)->unique();  // Nome do grupo de usuários
            $table->text('description')->nullable(); // Descrição do grupo
            $table->timestamps(); // created_at e updated_at
        });

        // Criando a tabela 'users' com a chave estrangeira user_group_id
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');                  // Nome do usuário
            $table->string('email')->unique();       // Email único do usuário
            $table->timestamp('email_verified_at')->nullable(); // Data de verificação de email
            $table->string('password');              // Senha do usuário
            $table->rememberToken();                 // Token de "lembrar-me" (para autenticação)
            $table->foreignId('user_group_id')       // Relacionamento com a tabela 'user_groups'
                ->nullable()                        // Tornando a chave estrangeira opcional
                ->constrained('user_groups')        // Referencia a tabela 'user_groups'
                ->onDelete('set null');             // Se o grupo de usuário for excluído, o campo será setado como null
            $table->timestamps();                   // created_at e updated_at
        });

        // Criando a tabela 'password_reset_tokens'
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();      // Email associado ao token de reset
            $table->string('token');                 // Token de reset de senha
            $table->timestamp('created_at')->nullable(); // Data de criação do token
        });

        // Criando a tabela 'sessions'
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();          // ID da sessão (chave primária)
            $table->foreignId('user_id')              // Relacionamento com a tabela 'users'
                ->nullable()->index();               // Chave estrangeira para usuário, e index para melhorar performance
            $table->string('ip_address', 45)->nullable(); // IP do usuário (formato IPv6)
            $table->text('user_agent')->nullable();    // User agent do navegador
            $table->longText('payload');               // Payload da sessão
            $table->integer('last_activity')->index(); // Última atividade da sessão (index para performance)
        });
    }

    /**
     * Reverse the migrations.
     *
     * Remove as tabelas criadas.
     */
    public function down(): void
    {
        // Deletando as tabelas na ordem correta para evitar problemas com chaves estrangeiras
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
        Schema::dropIfExists('user_groups');
    }
};
