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
        'fk_User_id',
        'fk_Category_id',
        'fk_TicketPriority_id',
        'fk_TicketStatus_id',
        'fk_Department_id'
    ];

    // Definir as relações
    public function user()
    {
        return $this->belongsTo(User::class, 'fk_User_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'fk_Category_id');
    }

    public function ticketPriority()
    {
        return $this->belongsTo(TicketPriority::class, 'fk_TicketPriority_id');
    }

    public function ticketStatus()
    {
        return $this->belongsTo(TicketStatus::class, 'fk_TicketStatus_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'fk_Department_id');
    }
}
