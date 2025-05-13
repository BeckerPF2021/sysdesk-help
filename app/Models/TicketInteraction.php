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
        'user_id',
        'ticket_id',  // Certifique-se de que o campo esteja correto, pode ser 'fk_ticket_id' dependendo do banco
    ];

    // Relacionamento com o usuário
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // A chave estrangeira é 'user_id'
    }

    // Relacionamento com o ticket
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'fk_ticket_id'); // Usando 'fk_ticket_id' como chave estrangeira
    }

    // Relacionamento com o tipo de interação
    public function interactionType()
    {
        return $this->belongsTo(InteractionType::class, 'interaction_type'); // Relacionamento com o tipo de interação
    }
}
