<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Address;

class AddressSeeder extends Seeder
{
    public function run(): void
    {
        Address::create([
            'logradouro'  => 'Rua das Flores',
            'numero'      => '123',
            'complemento' => 'Apto 101',
            'bairro'      => 'Centro',
            'cidade'      => 'Salvador',
            'estado'      => 'BA',
            'cep'         => '40000-000',
        ]);

        Address::create([
            'logradouro'  => 'Avenida Brasil',
            'numero'      => '456',
            'complemento' => null,
            'bairro'      => 'Copacabana',
            'cidade'      => 'Rio de Janeiro',
            'estado'      => 'RJ',
            'cep'         => '22000-000',
        ]);

        Address::create([
            'logradouro'  => 'Rua das Palmeiras',
            'numero'      => '789',
            'complemento' => 'Casa',
            'bairro'      => 'Jardins',
            'cidade'      => 'São Paulo',
            'estado'      => 'SP',
            'cep'         => '01000-000',
        ]);

        Address::create([
            'logradouro'  => 'Praça da Sé',
            'numero'      => '10',
            'complemento' => 'Sala 5',
            'bairro'      => 'Sé',
            'cidade'      => 'São Paulo',
            'estado'      => 'SP',
            'cep'         => '01001-000',
        ]);

        Address::create([
            'logradouro'  => 'Rua Bahia',
            'numero'      => '321',
            'complemento' => 'Bloco B',
            'bairro'      => 'Funcionários',
            'cidade'      => 'Belo Horizonte',
            'estado'      => 'MG',
            'cep'         => '30100-000',
        ]);
    }
}