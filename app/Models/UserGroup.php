<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    use HasFactory;

    /**
     * Os atributos que podem ser atribuídos em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',       // Nome do grupo
        'description',// Descrição do grupo
    ];

    /**
     * Os atributos que devem ser ocultados para serialização.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at', // Ocultar timestamp de criação
        'updated_at', // Ocultar timestamp de atualização
    ];

    /**
     * Relacionamentos com outros models podem ser adicionados aqui.
     *
     * Exemplo:
     * public function users()
     * {
     *     return $this->hasMany(User::class);
     * }
     */
}