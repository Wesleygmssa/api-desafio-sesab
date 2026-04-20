<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        Profile::create([
            'nome' => 'Administrador',
        ]);

        Profile::create([
            'nome' => 'Desenvolvedor Front-End',
        ]);

        Profile::create([
            'nome' => 'Desenvolvedor Back-End',
        ]);

        Profile::create([
            'nome' => 'Testes',
        ]);

        Profile::create([
            'nome' => 'Gerente de Projetos',
        ]);

        Profile::create([
            'nome' => 'Analista de QA',
        ]);
    }
}