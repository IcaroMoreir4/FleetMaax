<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MotoristaCaminhaoSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // Desativa FK
        DB::table('caminhoes')->truncate();
        DB::table('motoristas')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); // Reativa FK

        // Pega o ID da primeira empresa
        $empresa_id = DB::table('empresas')->first()->id;

        // Insere motoristas primeiro
        DB::table('motoristas')->insert([
            [
                'id' => 1,
                'empresa_id' => $empresa_id,
                'nome' => 'Carlos Silva',
                'cpf' => '12345678901',
                'cnh' => 'MG1234567',
                'telefone' => '(31) 99999-1234',
                'status' => 'ativo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'empresa_id' => $empresa_id,
                'nome' => 'Fernanda Costa',
                'cpf' => '98765432100',
                'cnh' => 'SP7654321',
                'telefone' => '(11) 98888-4321',
                'status' => 'ativo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'empresa_id' => $empresa_id,
                'nome' => 'Julio Pirangueiro Safado',
                'cpf' => '01010101010',
                'cnh' => 'PE7654321',
                'telefone' => '(87) 99253-6170',
                'status' => 'inativo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Depois insere caminhões com motorista_id correto
        DB::table('caminhoes')->insert([
            [
                'empresa_id' => $empresa_id,
                'implemento' => 'Carreta Sider',
                'marca_modelo' => 'Volvo FH 540',
                'ano' => '2018',
                'numero_chassi' => '9BWZZZ377VT004251',
                'placa' => 'ABC1D23',
                'cor' => 'Branco',
                'motorista_id' => 1,
                'status' => 'disponivel',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'empresa_id' => $empresa_id,
                'implemento' => 'Bitrem',
                'marca_modelo' => 'Scania R 450',
                'ano' => '2020',
                'numero_chassi' => '9BWZZZ377VT004252',
                'placa' => 'DEF4G56',
                'cor' => 'Vermelho',
                'motorista_id' => 2,
                'status' => 'em_uso',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'empresa_id' => $empresa_id,
                'implemento' => 'Truck',
                'marca_modelo' => 'Mercedes-Benz Actros',
                'ano' => '2015',
                'numero_chassi' => '9BWZZZ377VT004253',
                'placa' => 'GHI7J89',
                'cor' => 'Preto',
                'motorista_id' => null,
                'status' => 'manutencao',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
