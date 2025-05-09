<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'fk_user_id', // Corrigido para 'fk_user_id'
        'fk_category_id', // Corrigido para 'fk_category_id'
        'fk_ticket_priority_id', // Corrigido para 'fk_ticket_priority_id'
        'fk_ticket_status_id', // Corrigido para 'fk_ticket_status_id'
        'fk_department_id' // Corrigido para 'fk_department_id'
    ];

    // Relacionamento com o usuário
    public function user()
    {
        return $this->belongsTo(User::class, 'fk_user_id'); // Usando 'fk_user_id' corretamente
    }

    // Relacionamento com a categoria
    public function category()
    {
        return $this->belongsTo(Category::class, 'fk_category_id'); // Usando 'fk_category_id' corretamente
    }

    // Relacionamento com o tipo de prioridade do ticket
    public function ticketPriority()
    {
        return $this->belongsTo(TicketPriority::class, 'fk_ticket_priority_id'); // Usando 'fk_ticket_priority_id' corretamente
    }

    // Relacionamento com o status do ticket
    public function ticketStatus()
    {
        return $this->belongsTo(TicketStatus::class, 'fk_ticket_status_id'); // Usando 'fk_ticket_status_id' corretamente
    }

    // Relacionamento com o departamento
    public function department()
    {
        return $this->belongsTo(Department::class, 'fk_department_id'); // Usando 'fk_department_id' corretamente
    }

    // Relacionamento com as interações do ticket
    public function interactions()
    {
        return $this->hasMany(TicketInteraction::class, 'fk_ticket_id'); // Usando 'fk_ticket_id' corretamente
    }
}