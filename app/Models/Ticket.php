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
        'fk_user_id',              // usuário que abriu o chamado
        'fk_responsible_user_id',  // usuário responsável pelo chamado (novo)
        'fk_category_id',
        'fk_ticket_priority_id',
        'fk_ticket_status_id',
        'fk_department_id'
    ];

    // Usuário que abriu o chamado
    public function user()
    {
        return $this->belongsTo(User::class, 'fk_user_id');
    }

    // Usuário responsável pelo chamado
    public function responsibleUser()
    {
        return $this->belongsTo(User::class, 'fk_responsible_user_id');
    }

    // Categoria do chamado
    public function category()
    {
        return $this->belongsTo(Category::class, 'fk_category_id');
    }

    // Prioridade do chamado
    public function ticketPriority()
    {
        return $this->belongsTo(TicketPriority::class, 'fk_ticket_priority_id');
    }

    // Status do chamado
    public function ticketStatus()
    {
        return $this->belongsTo(TicketStatus::class, 'fk_ticket_status_id');
    }

    // Departamento responsável
    public function department()
    {
        return $this->belongsTo(Department::class, 'fk_department_id');
    }

    // Interações do ticket
    public function interactions()
    {
        return $this->hasMany(TicketInteraction::class, 'fk_ticket_id');
    }
}
