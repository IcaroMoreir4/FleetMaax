<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function test_tela_de_login_é_carregada()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Login');
    }

    public function test_usuario_pode_fazer_login_com_credenciais_validas()
    {
        $user = User::factory()->create([
            'email' => 'teste@example.com',
            'password' => Hash::make('senha123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'teste@example.com',
            'password' => 'senha123',
        ]);

        $response->assertRedirect('/dashboard'); //
        $this->assertAuthenticatedAs($user);
    }

    public function test_usuario_nao_pode_fazer_login_com_credenciais_invalidas()
    {
        User::factory()->create([
            'email' => 'teste@example.com',
            'password' => Hash::make('senha123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'teste@example.com',
            'password' => 'senha_errada',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_usuario_pode_se_registrar()
    {
        $response = $this->post('/register', [
            'name' => 'Usuário Teste',
            'email' => 'novo@teste.com',
            'password' => 'senha123',
            'password_confirmation' => 'senha123',
        ]);

        $response->assertRedirect('/dashboard'); // 
        $this->assertDatabaseHas('users', ['email' => 'novo@teste.com']);
        $this->assertAuthenticated();
    }

    public function test_registro_falha_se_dados_faltarem()
    {
        $response = $this->post('/register', []);
        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }
}
#PRA FAZER O TESTE COLOCA NO TERMINAL= test --filter=AuthTest
