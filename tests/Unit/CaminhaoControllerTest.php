<?php

namespace Tests\Feature;

use App\Models\Caminhao;
use App\Models\Motorista;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class CaminhaoControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    use WithoutMiddleware;


    public function test_index_caminhoes_retorna_view_com_caminhoes_e_motoristas()
    {
        Motorista::factory()->create();
        Caminhao::factory()->count(2)->create();

        $response = $this->get(route('caminhoes.index'));

        $response->assertStatus(200);
        $response->assertViewIs('caminhoes.index');
        $response->assertViewHas('caminhoes');
        $response->assertViewHas('motoristas');
    }

    public function test_store_cria_novo_caminhao_e_redireciona()
    {
        $motorista = Motorista::factory()->create();
        $data = [
            'implemento' => 'Graneleiro',
            'marca_modelo' => 'Scania R450',
            'ano' => '2021',
            'numero_chassi' => $this->faker->unique()->regexify('[A-HJ-NPR-Z0-9]{17}'),
            'placa' => $this->faker->unique()->regexify('[A-Z]{3}-[0-9][A-Z0-9][0-9]{2}'),
            'cor' => 'Branco',
            'motorista_id' => $motorista->id,
        ];

        $response = $this->post(route('caminhoes.store'), $data);

        $response->assertRedirect(route('caminhoes.index'));
        $response->assertSessionHas('success', 'Caminhão cadastrado com sucesso!');
        $this->assertDatabaseHas('caminhoes', ['placa' => $data['placa']]);
    }

    public function test_store_caminhao_sem_motorista()
    {
        $data = [
            'implemento' => 'Baú',
            'marca_modelo' => 'Volvo VM270',
            'ano' => '2019',
            'numero_chassi' => $this->faker->unique()->regexify('[A-HJ-NPR-Z0-9]{17}'),
            'placa' => $this->faker->unique()->regexify('[A-Z]{3}-[0-9][A-Z0-9][0-9]{2}'),
            'cor' => 'Prata',
            'motorista_id' => null,
        ];

        $response = $this->post(route('caminhoes.store'), $data);
        $response->assertRedirect(route('caminhoes.index'));
        $this->assertDatabaseHas('caminhoes', ['placa' => $data['placa'], 'motorista_id' => null]);
    }

    public function test_show_caminhao_retorna_view_com_caminhao()
    {
        $caminhao = Caminhao::factory()->create();

        $response = $this->get(route('caminhoes.show', $caminhao->id));

        $response->assertStatus(200);
        $response->assertViewIs('caminhoes.show');
        $response->assertViewHas('caminhao', $caminhao);
    }

    public function test_edit_caminhao_retorna_view_com_caminhao_e_motoristas()
    {
        Motorista::factory()->create();
        $caminhao = Caminhao::factory()->create();

        $response = $this->get(route('caminhoes.edit', $caminhao->id));

        $response->assertStatus(200);
        $response->assertViewIs('caminhoes.edit');
        $response->assertViewHas('caminhao', $caminhao);
        $response->assertViewHas('motoristas');
    }

    public function test_update_atualiza_caminhao_e_redireciona()
    {
        $motorista = Motorista::factory()->create();
        $caminhao = Caminhao::factory()->create();

        $newData = [
            'implemento' => 'Sider Atualizado',
            'marca_modelo' => 'Mercedes-Benz Actros 2651', // Corrigido: sem campo 'modelo' separado
            'ano' => '2022',
            'numero_chassi' => $caminhao->numero_chassi, // Não pode mudar ou deve ser único
            'placa' => $caminhao->placa,             // Não pode mudar ou deve ser única
            'cor' => 'Preto Fosco',
            'motorista_id' => $motorista->id,
        ];

        $response = $this->put(route('caminhoes.update', $caminhao->id), $newData);

        $response->assertRedirect(route('caminhoes.show', $caminhao->id));
        $response->assertSessionHas('success', 'Caminhão atualizado com sucesso.');
        $this->assertDatabaseHas('caminhoes', [
            'id' => $caminhao->id,
            'implemento' => 'Sider Atualizado',
            'marca_modelo' => 'Mercedes-Benz Actros 2651',
            'cor' => 'Preto Fosco'
        ]);
    }

    public function test_update_caminhao_com_nova_placa_e_chassi_unicos()
    {
        $caminhao = Caminhao::factory()->create();
        // Garante que não haja conflito com o próprio caminhão, mas com outros se existissem.
        // A regra unique já ignora o ID atual na validação do controller.

        $novaPlaca = $this->faker->unique()->regexify('[A-Z]{3}-[0-9][A-Z0-9][0-9]{2}');
        $novoChassi = $this->faker->unique()->regexify('[A-HJ-NPR-Z0-9]{17}');

        $newData = [
            'implemento' => $caminhao->implemento,
            'marca_modelo' => $caminhao->marca_modelo,
            'ano' => $caminhao->ano,
            'numero_chassi' => $novoChassi,
            'placa' => $novaPlaca,
            'cor' => $caminhao->cor,
            'motorista_id' => optional($caminhao->motorista)->id,
        ];

        $response = $this->put(route('caminhoes.update', $caminhao->id), $newData);

        $response->assertRedirect(route('caminhoes.show', $caminhao->id));
        $this->assertDatabaseHas('caminhoes', [
            'id' => $caminhao->id,
            'placa' => $novaPlaca,
            'numero_chassi' => $novoChassi,
        ]);
    }

    public function test_destroy_remove_caminhao_e_redireciona()
    {
        $caminhao = Caminhao::factory()->create();

        $response = $this->delete(route('caminhoes.destroy', $caminhao->id));

        $response->assertRedirect(route('caminhoes.index'));
        $response->assertSessionHas('success', 'Caminhão removido!');
        $this->assertDatabaseMissing('caminhoes', ['id' => $caminhao->id]);
    }

    // Testes de validação (exemplo para store)
    public function test_store_caminhao_falha_com_dados_invalidos()
    {
        $response = $this->post(route('caminhoes.store'), []);
        $response->assertSessionHasErrors(['implemento', 'marca_modelo', 'ano', 'numero_chassi', 'placa', 'cor']);
    }

    public function test_store_caminhao_falha_com_placa_duplicada()
    {
        $caminhaoExistente = Caminhao::factory()->create();
        $data = Caminhao::factory()->make(['placa' => $caminhaoExistente->placa])->toArray();
        // Adiciona motorista_id se a factory não o fizer e for necessário para outros campos passarem na validação
        if (!isset($data['motorista_id']) && Motorista::count() > 0) {
            $data['motorista_id'] = Motorista::first()->id;
        }


        $response = $this->post(route('caminhoes.store'), $data);
        $response->assertSessionHasErrors(['placa']);
    }
}