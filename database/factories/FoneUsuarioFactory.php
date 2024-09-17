<?php

namespace Database\Factories;

use App\Models\FoneUsuario;
use App\Models\Usuario;
use App\Models\Telefone;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FoneUser>
 */
class FoneUsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = FoneUsuario::class;

    public function definition(): array
    {
        return [
            //
            'numFoneUsuario' => $this->faker->phoneNumber,
            'idUsuario' => Usuario::factory(),
            'idTelefone' => Telefone::factory(),
        ];
    }
}
