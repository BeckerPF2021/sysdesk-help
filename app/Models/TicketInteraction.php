<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketInteraction extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'comment_date',
        'interaction_type',
        'file_type',
        'file_size',
        'file_path',         // Adicionado campo file_path
        'fk_user_id',
        'fk_ticket_id',
    ];

    /**
     * Relacionamento com o usuário que fez a interação
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'fk_user_id');
    }

    /**
     * Relacionamento com o ticket relacionado
     */
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'fk_ticket_id');
    }

    /**
     * Relacionamento com o tipo de interação
     */
    public function interactionType()
    {
        return $this->belongsTo(InteractionType::class, 'interaction_type');
    }
}
