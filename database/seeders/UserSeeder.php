<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Usuário 1
        User::create([
            'nome'       => 'Admin',
            'email'      => 'admin@teste.com',
            'cpf'        => '00000000000',
            'password'   => Hash::make('senha123'),
            'profile_id' => 1, // perfil administrador
            'session_id' => Str::uuid(),
        ]);

        // Usuário 2
        User::create([
            'nome'       => 'Wesley Guerra',
            'email'      => 'wesleyguerra@dev.com.br',
            'cpf'        => '11111111111',
            'profile_id' => 2, // pode ser o mesmo perfil ou outro
            'session_id' => Str::uuid(),
        ]);
    }
}