<?php

namespace Database\Factories;

use App\Models\Motorista;
use Illuminate\Database\Eloquent\Factories\Factory;

class MotoristaFactory extends Factory
{
    protected $model = Motorista::class;

    public function definition()
    {
        return [
            'nome_completo' => $this->faker->name(),
            'cpf' => $this->faker->unique()->numerify('###########'), // 11 digitos
            'cnh' => $this->faker->unique()->numerify('###########'), // 11 digitos
            'data_nascimento' => $this->faker->date(),
            'email' => $this->faker->unique()->safeEmail(),
            'telefone' => $this->faker->phoneNumber(),
            'data_admissao' => $this->faker->date(),
            'ativo' => $this->faker->boolean(),
        ];
    }
}