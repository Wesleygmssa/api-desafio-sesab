<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['logradouro', 'cep'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}