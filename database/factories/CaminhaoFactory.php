<?php

namespace Database\Factories;

use App\Models\Caminhao;
use App\Models\Motorista; // Certifique-se que este use statement existe se for usar Motorista::factory()
use Illuminate\Database\Eloquent\Factories\Factory;

class CaminhaoFactory extends Factory
{
    protected $model = Caminhao::class;

    public function definition()
    {
        return [
            'implemento' => $this->faker->word(),
            // CORREÇÃO APLICADA AQUI:
            'marca_modelo' => $this->faker->company() . ' ' . $this->faker->word(), // Usado word() em vez de vehicleModel()
            'ano' => $this->faker->year(),
            'numero_chassi' => $this->faker->unique()->regexify('[A-HJ-NPR-Z0-9]{17}'),
            'placa' => $this->faker->unique()->regexify('[A-Z]{3}-[0-9][A-Z0-9][0-9]{2}'),
            'cor' => $this->faker->colorName(),
            'motorista_id' => null, // Pode ser Motorista::factory() se quiser associar sempre um motorista
        ];
    }
}