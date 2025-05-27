<?php

namespace Tests\Feature; // Certifique-se que está em tests/Feature/

use App\Models\Motorista;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class MotoristaControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    use WithoutMiddleware;


    public function test_index_motoristas_retorna_view_com_motoristas()
    {
        Motorista::factory()->count(3)->create();

        $response = $this->get(route('motoristas.index'));

        $response->assertStatus(200);
        $response->assertViewIs('motoristas.index');
        $response->assertViewHas('motoristas', function ($motoristas) {
            return $motoristas->count() === 3;
        });
    }

    public function test_store_cria_novo_motorista_e_redireciona()
    {
        $data = [
            'nome_completo' => 'João Teste Silva',
            'cpf' => $this->faker->unique()->numerify('###########'),
            'cnh' => $this->faker->unique()->numerify('###########'),
            'data_nascimento' => '1990-01-01',
            'email' => $this->faker->unique()->safeEmail(),
            'telefone' => '99999-9999',
            'data_admissao' => '2023-01-01',
            'ativo' => true,
        ];

        $response = $this->post(route('motoristas.store'), $data);

        // Se o erro 419 persistir, descomente as linhas abaixo para depurar:
        // if ($response->status() === 419) {
        //     dump('Erro 419 detectado no teste store_cria_novo_motorista_e_redireciona');
        //     // dump($response->content()); // Pode mostrar a página de erro CSRF
        // }

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Motorista cadastrado com sucesso!');
        $this->assertDatabaseHas('motoristas', ['cpf' => $data['cpf']]);
    }

    public function test_store_motorista_com_ativo_nao_enviado_define_como_false()
    {
        $data = [
            'nome_completo' => 'Maria Teste Oliveira',
            'cpf' => $this->faker->unique()->numerify('###########'),
            'cnh' => $this->faker->unique()->numerify('###########'),
            'data_nascimento' => '1985-05-10',
            'email' => $this->faker->unique()->safeEmail(),
            'telefone' => '88888-8888',
            'data_admissao' => '2022-03-15',
            // 'ativo' não é enviado
        ];

        $response = $this->post(route('motoristas.store'), $data);

        // if ($response->status() === 419) {
        //     dump('Erro 419 detectado no teste store_motorista_com_ativo_nao_enviado_define_como_false');
        // } else if (!$this->getDatabaseConnection()->table('motoristas')->where('cpf', $data['cpf'])->exists()) {
        //    dump('Motorista não foi criado. Resposta do POST:', $response->status(), $response->content());
        //    $response->dumpSession();
        //}


        $this->assertDatabaseHas('motoristas', ['cpf' => $data['cpf'], 'ativo' => false]);
        // Se o assertDatabaseHas falhar, verifique se a validação passou e o motorista foi realmente criado.
        // O controller deve definir 'ativo' como false se não estiver presente.
    }

    public function test_edit_motorista_retorna_view_com_motorista()
    {
        $motorista = Motorista::factory()->create();

        $response = $this->get(route('motoristas.edit', $motorista->id));

        $response->assertStatus(200);
        $response->assertViewIs('motoristas.edit');
        $response->assertViewHas('motorista', $motorista);
    }

    public function test_update_atualiza_motorista_e_redireciona()
    {
        $motorista = Motorista::factory()->create();
        $newData = [
            'nome_completo' => 'Carlos Teste Atualizado',
            'cpf' => $motorista->cpf,
            'cnh' => $motorista->cnh,
            'data_nascimento' => '1992-02-02',
            'email' => $this->faker->unique()->safeEmail(),
            'telefone' => '77777-7777',
            'data_admissao' => '2024-01-01',
            'ativo' => false,
        ];

        $response = $this->put(route('motoristas.update', $motorista->id), $newData);

        $response->assertRedirect(route('motoristas.index'));
        $response->assertSessionHas('success', 'Motorista atualizado com sucesso!');
        $this->assertDatabaseHas('motoristas', ['id' => $motorista->id, 'nome_completo' => 'Carlos Teste Atualizado', 'ativo' => false]);
    }

    public function test_update_motorista_com_cpf_e_cnh_unicos()
    {
        $motorista1 = Motorista::factory()->create();
        Motorista::factory()->create(); // Cria outro para garantir que a validação unique funcione corretamente

        $newData = [
            'nome_completo' => 'Pedro Teste CNH CPF',
            'cpf' => $this->faker->unique()->numerify('###########'),
            'cnh' => $this->faker->unique()->numerify('###########'),
            'data_nascimento' => '1995-03-03',
            'email' => $this->faker->unique()->safeEmail(),
            'telefone' => '66666-6666',
            'data_admissao' => '2023-05-05',
            'ativo' => true,
        ];

        $response = $this->put(route('motoristas.update', $motorista1->id), $newData);

        $response->assertRedirect(route('motoristas.index'));
        $this->assertDatabaseHas('motoristas', ['id' => $motorista1->id, 'cpf' => $newData['cpf'], 'cnh' => $newData['cnh']]);
    }


    public function test_destroy_remove_motorista_e_redireciona()
    {
        $motorista = Motorista::factory()->create();

        $response = $this->delete(route('motoristas.destroy', $motorista->id));

        $response->assertRedirect(route('motoristas.index'));
        $response->assertSessionHas('success', 'Motorista removido com sucesso!');
        $this->assertDatabaseMissing('motoristas', ['id' => $motorista->id]);
    }

    public function test_show_motorista_retorna_view_com_motorista()
    {
        $motorista = Motorista::factory()->create();

        $response = $this->get(route('motoristas.show', $motorista->id));

        $response->assertStatus(200);
        $response->assertViewIs('motoristas.show');
        $response->assertViewHas('motorista', $motorista);
    }

    public function test_store_motorista_falha_com_dados_invalidos()
    {
        $response = $this->post(route('motoristas.store'), []); // Envia dados vazios para forçar erros de validação
        $response->assertStatus(302); // Espera um redirect de volta devido a erros de validação
        $response->assertSessionHasErrors(['nome_completo', 'cpf', 'cnh', 'data_nascimento', 'email', 'telefone', 'data_admissao']);
    }

    public function test_store_motorista_falha_com_cpf_duplicado()
    {
        $motoristaExistente = Motorista::factory()->create();
        $data = Motorista::factory()->make(['cpf' => $motoristaExistente->cpf])->toArray();

        $response = $this->post(route('motoristas.store'), $data);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['cpf']);
    }
}