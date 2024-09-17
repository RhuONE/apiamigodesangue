<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Hemocentro;
use App\Models\Usuario;
use App\Models\Telefone;
use App\Models\FoneUsuario;
use App\Models\TipoSanguineo;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Hemocentro::factory()->count(10)->create();
        Usuario::factory()->count(10)->create();
        Telefone::factory()->count(10)->create();
        
        TipoSanguineo::factory()->count(8)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
