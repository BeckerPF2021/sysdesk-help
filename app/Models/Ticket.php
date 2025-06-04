<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'fk_user_id',              // usuário que abriu o chamado
        'fk_responsible_user_id',  // usuário responsável pelo chamado
        'fk_category_id',
        'fk_ticket_priority_id',
        'fk_ticket_status_id',
        'fk_department_id'
    ];

    // Opcional: já carregar essas relações automaticamente
    // protected $with = ['user', 'responsibleUser', 'category', 'ticketPriority', 'ticketStatus', 'department'];

    // Usuário que abriu o chamado
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'fk_user_id');
    }

    // Usuário responsável pelo chamado
    public function responsibleUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'fk_responsible_user_id');
    }

    // Categoria do chamado
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'fk_category_id');
    }

    // Prioridade do chamado
    public function ticketPriority(): BelongsTo
    {
        return $this->belongsTo(TicketPriority::class, 'fk_ticket_priority_id');
    }

    // Status do chamado
    public function ticketStatus(): BelongsTo
    {
        return $this->belongsTo(TicketStatus::class, 'fk_ticket_status_id');
    }

    // Departamento responsável
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'fk_department_id');
    }

    // Interações do ticket
    public function interactions(): HasMany
    {
        return $this->hasMany(TicketInteraction::class, 'fk_ticket_id');
    }
}
