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

        // Insere motoristas primeiro
        DB::table('motoristas')->insert([
            [
                'id' => 1,
                'nome_completo' => 'Carlos Silva',
                'cpf' => '12345678901',
                'cnh' => 'MG1234567',
                'data_nascimento' => '1985-03-15',
                'email' => 'carlos.silva@example.com',
                'telefone' => '(31) 99999-1234',
                'data_admissao' => '2010-06-01',
                'ativo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nome_completo' => 'Fernanda Costa',
                'cpf' => '98765432100',
                'cnh' => 'SP7654321',
                'data_nascimento' => '1990-11-25',
                'email' => 'fernanda.costa@example.com',
                'telefone' => '(11) 98888-4321',
                'data_admissao' => '2015-09-10',
                'ativo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

                        [
                'id' => 3,
                'nome_completo' => 'Julio Pirangueiro Safado',
                'cpf' => '01010101010',
                'cnh' => 'PE7654321',
                'data_nascimento' => '1999-11-25',
                'email' => 'juliogostoa@gmail.com',
                'telefone' => '(87) 99253-6170',
                'data_admissao' => '2015-09-10',
                'ativo' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Depois insere caminhões com motorista_id correto
        DB::table('caminhoes')->insert([
            [
                'implemento' => 'Carreta Sider',
                'marca_modelo' => 'Volvo FH 540',
                'ano' => '2018',
                'numero_chassi' => '9BWZZZ377VT004251',
                'placa' => 'ABC1D23',
                'cor' => 'Branco',
                'motorista_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'implemento' => 'Bitrem',
                'marca_modelo' => 'Scania R 450',
                'ano' => '2020',
                'numero_chassi' => '9BWZZZ377VT004252',
                'placa' => 'DEF4G56',
                'cor' => 'Vermelho',
                'motorista_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'implemento' => 'Truck',
                'marca_modelo' => 'Mercedes-Benz Actros',
                'ano' => '2015',
                'numero_chassi' => '9BWZZZ377VT004253',
                'placa' => 'GHI7J89',
                'cor' => 'Preto',
                'motorista_id' => null, // Sem motorista associado
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
