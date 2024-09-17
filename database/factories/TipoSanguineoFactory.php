<?php

namespace Database\Factories;

use App\Models\TipoSanguineo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TipoSanguineo>
 */
class TipoSanguineoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    protected $model = TipoSanguineo::class;


    public function definition(): array
    {
        return [
            //
            'descTipoSanguineo' => $this->faker->unique()->randomElement([
                'O+',
                'O-',
                'A+',
                'A-',
                'B+',
                'B-',
                'AB+',
                'AB-'
            ]),
        ];
    }
}
