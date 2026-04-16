<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class User extends Model
{
   protected $fillable = [
    'nome',
    'email',
    'cpf',
    'profile_id',
    'session_id'
];

    /**
     * Gera session_id automaticamente ao criar usuário
     */
    protected static function booted()
    {
        static::creating(function ($user) {
            if (empty($user->session_id)) {
                $user->session_id = Str::uuid();
            }
        });
    }

    /**
     * Relacionamento com Profile
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    /**
     * Relacionamento com Address (N:N)
     */
    public function addresses()
    {
        return $this->belongsToMany(Address::class);
    }
}