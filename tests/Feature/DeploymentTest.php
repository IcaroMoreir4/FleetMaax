<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Caminhao;
use Illuminate\Support\Facades\Artisan;

class DeploymentTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate');
    }

    public function test_database_connection()
    {
        try {
            DB::connection()->getPdo();
            $this->assertTrue(true);
        } catch (\Exception $e) {
            $this->fail('Conexão com o banco de dados falhou: ' . $e->getMessage());
        }
    }

    public function test_migrations_run_successfully()
    {
        $this->assertTrue(
            DB::table('migrations')->count() > 0,
            'As migrações não foram executadas corretamente'
        );
    }

    public function test_caminhoes_page_loads()
    {
        $response = $this->get('/caminhoes');
        $response->assertStatus(200);
    }

    public function test_can_create_caminhao()
    {
        $caminhaoData = [
            'implemento' => 'Teste Implemento',
            'marca_modelo' => 'Teste Marca/Modelo',
            'ano' => '2024',
            'numero_chassi' => '123456789',
            'placa' => 'ABC1234',
            'cor' => 'Preto',
            'status' => 'disponivel'
        ];

        $response = $this->post('/caminhoes', $caminhaoData);
        $response->assertStatus(302); // Redirecionamento após criação

        $this->assertDatabaseHas('caminhoes', [
            'implemento' => 'Teste Implemento',
            'placa' => 'ABC1234'
        ]);
    }

    public function test_env_variables_are_set()
    {
        $requiredEnvVars = [
            'DB_CONNECTION',
            'DB_HOST',
            'DB_PORT',
            'DB_DATABASE',
            'APP_KEY'
        ];

        foreach ($requiredEnvVars as $var) {
            $this->assertNotEmpty(
                env($var),
                "A variável de ambiente {$var} não está definida"
            );
        }
    }

    public function test_storage_directory_is_writable()
    {
        $this->assertTrue(
            is_writable(storage_path('app')),
            'O diretório storage/app não tem permissão de escrita'
        );
        
        $this->assertTrue(
            is_writable(storage_path('logs')),
            'O diretório storage/logs não tem permissão de escrita'
        );
    }
} 