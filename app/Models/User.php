<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_group_id',
        'phone',
        'role',
        'department',
        'profile_picture_url',
        'active',
    ];

    /**
     * The attributes that should be hidden for arrays and JSON.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'active' => 'boolean',
    ];

    /**
     * Relacionamento com a tabela user_groups.
     */
    public function userGroup()
    {
        return $this->belongsTo(UserGroup::class);
    }

    /**
     * Accessor para URL completa da imagem de perfil.
     *
     * @param string|null $value
     * @return string
     */
    public function getProfilePictureUrlAttribute($value)
    {
        if ($value && \Storage::disk('public')->exists($value)) {
            return asset('storage/' . $value);
        }

        $emailHash = md5(strtolower(trim($this->email)));
        return "https://www.gravatar.com/avatar/$emailHash?d=mp&s=120";
    }
}
