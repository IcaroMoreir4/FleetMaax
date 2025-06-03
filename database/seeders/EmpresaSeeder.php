<?php

namespace Database\Seeders;

use App\Models\Empresa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmpresaSeeder extends Seeder
{
    public function run(): void
    {
        Empresa::create([
            'cnpj' => '12345678000195',
            'razaoSocial' => 'Empresa Teste',
            'email' => 'teste@empresa.com',
            'password' => Hash::make('123456'),
        ]);
    }
} 