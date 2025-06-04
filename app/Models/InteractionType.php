<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InteractionType extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Se quiser relacionamento com interações, pode criar depois (exemplo):
    // public function interactions()
    // {
    //     return $this->hasMany(TicketInteraction::class, 'fk_interaction_type_id');
    // }
}
