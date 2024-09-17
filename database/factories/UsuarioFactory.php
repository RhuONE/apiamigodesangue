<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class UsuarioFactory extends Factory
{
    protected $model = Usuario::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = Faker::create();
        
        return [
            'fotoUsuario' =>$faker->imageUrl(640, 480, 'health', true, 'usuario'),
            'nomeUsuario' => $faker->name,
            'dataNascUsuario' => $faker->date,
            'generoUsuario' => $faker->randomElement(['masculino', 'feminino']),
            'emailUsuario' => $faker->unique()->safeEmail,
            'senhaUsuario' => bcrypt('senha123'), // Use bcrypt para simular a senha criptografada
            'cpfUsuario' => $faker->numerify('###.###.###-##'), // Adicione o método cpf se usar um pacote faker personalizado
            'logUsuario' => $faker->streetAddress,
            'numLogUsuario' => $faker->numberBetween(1, 1000),
            'compUsuario' => $faker->optional()->word,
            'bairroUsuario' => $faker->word,
            'cidadeUsuario' => $faker->city,
            'estadoUsuario' => $faker->stateAbbr, // Dois caracteres para o estado
            'cepUsuario' => $faker->postcode,
            'rgUsuario' => $faker->optional()->word,
            'statusUsuario' => $faker->randomElement(['ativo', 'arquivado']),
            'tipoUsuario' => $faker->randomElement(['doador', 'administrador']),
            'descTipoSanguineo' => $this->faker->randomElement([
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

