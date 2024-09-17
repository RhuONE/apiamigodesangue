<?php

namespace Database\Factories;

use App\Models\Hemocentro;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class HemocentroFactory extends Factory
{
    protected $model = Hemocentro::class;

    public function definition()
    {
        return [
            'fotoHemocentro' => $this->faker->imageUrl(640, 480, 'health', true, 'hemocentro'),
            'nomeHemocentro' => $this->faker->company(),
            'descHemocentro' => $this->faker->paragraph(),
            'telHemocentro'  => $this->faker->phoneNumber(),
            'cepHemocentro'  => $this->faker->postcode(),
            'logHemocentro'  => $this->faker->streetName(),
            'numLogHemocentro' => $this->faker->buildingNumber(),
            'compHemocentro' => $this->faker->secondaryAddress(),
            'bairroHemocentro' => $this->faker->citySuffix(),
            'cidadeHemocentro' => $this->faker->city(),
            'estadoHemocentro' => $this->faker->stateAbbr(),
            'emailHemocentro'  => $this->faker->unique()->safeEmail(),
            'senhaHemocentro'  => bcrypt('password'),  // Criptografia de senha simples
            'latitudeHemocentro'  => $this->faker->latitude(-90, 90),  // Coordenadas de GPS reais
            'longitudeHemocentro' => $this->faker->longitude(-180, 180),  // Coordenadas de GPS reais
            'statusHemocentro' => $this->faker->randomElement(['pendente', 'ativo', 'arquivado']),  // Status aleatório
        ];
    }
}