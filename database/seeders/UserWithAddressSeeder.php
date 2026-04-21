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
        // Usuário 1 - Admin
        $user1 = User::create([
            'nome'       => 'Usuário Admin',
            'email'      => 'admin@teste.com',
            'cpf'        => '00000000000',
            'password'   => Hash::make('senha123'),
            'profile_id' => 1,
            'session_id' => Str::uuid(),
        ]);

        $address1 = Address::create([
            'logradouro'  => 'Rua das Flores',
            'numero'      => '100',
            'complemento' => null,
            'bairro'      => 'Centro',
            'cidade'      => 'Salvador',
            'estado'      => 'BA',
            'cep'         => '40000-000',
        ]);

        $user1->addresses()->attach($address1->id);

        // Usuário 2
        $user2 = User::create([
            'nome'       => 'Camila Rocha',
            'email'      => 'camilarocha@teste.com',
            'cpf'        => '04230530546',
            'password'   => Hash::make('senha123'),
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

        $user2->addresses()->attach($address2->id);

        // Usuário 3
        $user3 = User::create([
            'nome'       => 'João Silva',
            'email'      => 'joao.silva@teste.com',
            'cpf'        => '12345678901',
            'password'   => Hash::make('senha123'),
            'profile_id' => 2,
            'session_id' => Str::uuid(),
        ]);

        $address3 = Address::create([
            'logradouro'  => 'Rua A',
            'numero'      => '10',
            'complemento' => null,
            'bairro'      => 'Centro',
            'cidade'      => 'Salvador',
            'estado'      => 'BA',
            'cep'         => '40010-000',
        ]);

        $user3->addresses()->attach($address3->id);

        // Usuário 4
        $user4 = User::create([
            'nome'       => 'Maria Souza',
            'email'      => 'maria.souza@teste.com',
            'cpf'        => '98765432100',
            'password'   => Hash::make('senha123'),
            'profile_id' => 2,
            'session_id' => Str::uuid(),
        ]);

        $address4 = Address::create([
            'logradouro'  => 'Rua B',
            'numero'      => '22',
            'bairro'      => 'Barra',
            'cidade'      => 'Salvador',
            'estado'      => 'BA',
            'cep'         => '40140-000',
        ]);

        $user4->addresses()->attach($address4->id);

        // Usuário 5
        $user5 = User::create([
            'nome'       => 'Pedro Santos',
            'email'      => 'pedro.santos@teste.com',
            'cpf'        => '11122233344',
            'password'   => Hash::make('senha123'),
            'profile_id' => 3,
            'session_id' => Str::uuid(),
        ]);

        $address5 = Address::create([
            'logradouro'  => 'Rua C',
            'numero'      => '300',
            'bairro'      => 'Pituba',
            'cidade'      => 'Salvador',
            'estado'      => 'BA',
            'cep'         => '41810-000',
        ]);

        $user5->addresses()->attach($address5->id);

        // Usuário 6
        $user6 = User::create([
            'nome'       => 'Ana Lima',
            'email'      => 'ana.lima@teste.com',
            'cpf'        => '55566677788',
            'password'   => Hash::make('senha123'),
            'profile_id' => 2,
            'session_id' => Str::uuid(),
        ]);

        $address6 = Address::create([
            'logradouro'  => 'Rua D',
            'numero'      => '12',
            'bairro'      => 'Imbuí',
            'cidade'      => 'Salvador',
            'estado'      => 'BA',
            'cep'         => '41720-000',
        ]);

        $user6->addresses()->attach($address6->id);

        // Usuário 7
        $user7 = User::create([
            'nome'       => 'Carlos Oliveira',
            'email'      => 'carlos.oliveira@teste.com',
            'cpf'        => '22233344455',
            'password'   => Hash::make('senha123'),
            'profile_id' => 3,
            'session_id' => Str::uuid(),
        ]);

        $address7 = Address::create([
            'logradouro'  => 'Av Paralela',
            'numero'      => '900',
            'bairro'      => 'Paralela',
            'cidade'      => 'Salvador',
            'estado'      => 'BA',
            'cep'         => '41730-000',
        ]);

        $user7->addresses()->attach($address7->id);

        // Usuário 8
        $user8 = User::create([
            'nome'       => 'Juliana Costa',
            'email'      => 'juliana.costa@teste.com',
            'cpf'        => '33344455566',
            'password'   => Hash::make('senha123'),
            'profile_id' => 2,
            'session_id' => Str::uuid(),
        ]);

        $address8 = Address::create([
            'logradouro'  => 'Rua E',
            'numero'      => '88',
            'bairro'      => 'Rio Vermelho',
            'cidade'      => 'Salvador',
            'estado'      => 'BA',
            'cep'         => '41940-000',
        ]);

        $user8->addresses()->attach($address8->id);

        // Usuário 9
        $user9 = User::create([
            'nome'       => 'Lucas Pereira',
            'email'      => 'lucas.pereira@teste.com',
            'cpf'        => '44455566677',
            'password'   => Hash::make('senha123'),
            'profile_id' => 2,
            'session_id' => Str::uuid(),
        ]);

        $address9 = Address::create([
            'logradouro'  => 'Rua F',
            'numero'      => '77',
            'bairro'      => 'Itapuã',
            'cidade'      => 'Salvador',
            'estado'      => 'BA',
            'cep'         => '41610-000',
        ]);

        $user9->addresses()->attach($address9->id);

        // Usuário 10
        $user10 = User::create([
            'nome'       => 'Fernanda Alves',
            'email'      => 'fernanda.alves@teste.com',
            'cpf'        => '55544433322',
            'password'   => Hash::make('senha123'),
            'profile_id' => 3,
            'session_id' => Str::uuid(),
        ]);

        $address10 = Address::create([
            'logradouro'  => 'Rua G',
            'numero'      => '66',
            'bairro'      => 'Brotas',
            'cidade'      => 'Salvador',
            'estado'      => 'BA',
            'cep'         => '40280-000',
        ]);

        $user10->addresses()->attach($address10->id);

        // Usuário 11
        $user11 = User::create([
            'nome'       => 'Rafael Gomes',
            'email'      => 'rafael.gomes@teste.com',
            'cpf'        => '66677788899',
            'password'   => Hash::make('senha123'),
            'profile_id' => 2,
            'session_id' => Str::uuid(),
        ]);

        $address11 = Address::create([
            'logradouro'  => 'Rua H',
            'numero'      => '120',
            'bairro'      => 'Cabula',
            'cidade'      => 'Salvador',
            'estado'      => 'BA',
            'cep'         => '41150-000',
        ]);

        $user11->addresses()->attach($address11->id);

        // Usuário 12
        $user12 = User::create([
            'nome'       => 'Patrícia Nunes',
            'email'      => 'patricia.nunes@teste.com',
            'cpf'        => '77788899900',
            'password'   => Hash::make('senha123'),
            'profile_id' => 2,
            'session_id' => Str::uuid(),
        ]);

        $address12 = Address::create([
            'logradouro'  => 'Rua I',
            'numero'      => '45',
            'bairro'      => 'Stiep',
            'cidade'      => 'Salvador',
            'estado'      => 'BA',
            'cep'         => '41770-000',
        ]);

        $user12->addresses()->attach($address12->id);

        // Usuário 13
        $user13 = User::create([
            'nome'       => 'Bruno Martins',
            'email'      => 'bruno.martins@teste.com',
            'cpf'        => '88899900011',
            'password'   => Hash::make('senha123'),
            'profile_id' => 3,
            'session_id' => Str::uuid(),
        ]);

        $address13 = Address::create([
            'logradouro'  => 'Rua J',
            'numero'      => '33',
            'bairro'      => 'São Marcos',
            'cidade'      => 'Salvador',
            'estado'      => 'BA',
            'cep'         => '41250-000',
        ]);

        $user13->addresses()->attach($address13->id);

        // Usuário 14
        $user14 = User::create([
            'nome'       => 'Larissa Dias',
            'email'      => 'larissa.dias@teste.com',
            'cpf'        => '99900011122',
            'password'   => Hash::make('senha123'),
            'profile_id' => 2,
            'session_id' => Str::uuid(),
        ]);

        $address14 = Address::create([
            'logradouro'  => 'Rua K',
            'numero'      => '10',
            'bairro'      => 'Cajazeiras',
            'cidade'      => 'Salvador',
            'estado'      => 'BA',
            'cep'         => '41300-000',
        ]);

        $user14->addresses()->attach($address14->id);

        // Usuário 15
        $user15 = User::create([
            'nome'       => 'Diego Rocha',
            'email'      => 'diego.rocha@teste.com',
            'cpf'        => '10101010101',
            'password'   => Hash::make('senha123'),
            'profile_id' => 3,
            'session_id' => Str::uuid(),
        ]);

        $address15 = Address::create([
            'logradouro'  => 'Rua L',
            'numero'      => '500',
            'bairro'      => 'São Cristóvão',
            'cidade'      => 'Salvador',
            'estado'      => 'BA',
            'cep'         => '41500-000',
        ]);

        $user15->addresses()->attach($address15->id);
    }
}