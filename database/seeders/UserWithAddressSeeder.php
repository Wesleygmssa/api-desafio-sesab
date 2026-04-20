<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserWithAddressSeeder extends Seeder
{
    public function run(): void
    {
        // Usuário 1
        $user1 = User::create([
            'nome'       => 'Usuário Admin',
            'email'      => 'admin@teste.com',
            'cpf'        => '00000000000',
            'password'   => Hash::make('senha123'),
            'profile_id' => 1, 
            'session_id' => Str::uuid(),
        ]);



        // Usuário 2
        $user2 = User::create([
            'nome'       => 'Wesley Guerra',
            'email'      => 'wesleyguerra@teste.com',
            'cpf'        => '04230530546',
            // 'password'   => Hash::make('senha456'),
            'profile_id' => 3,
            'session_id' => Str::uuid(),
        ]);

        $address2 = Address::create([
            'logradouro'  => 'Avenida Brasil',
            'numero'      => '456',
            'complemento' => null,
            'bairro'      => 'Copacabana',
            'cidade'      => 'Rio de Janeiro',
            'estado'      => 'RJ',
            'cep'         => '22000-000',
        ]);

        $user2->addresses()->attach($address2->id); // VINCULAR O ENDEREÇO AO USUÁRIO 2
    }
}