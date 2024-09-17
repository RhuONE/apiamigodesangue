<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Model
{
    use HasFactory;
    use HasApiTokens;

    // Definindo o nome da tabela
    protected $table = 'tbUsuario';

    protected $primaryKey = 'idUsuario';

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'fotoUsuario',
        'nomeUsuario',
        'dataNascUsuario',
        'generoUsuario',
        'emailUsuario',
        'senhaUsuario',
        'cpfUsuario',
        'logUsuario',
        'numLogUsuario',
        'compUsuario',
        'bairroUsuario',
        'cidadeUsuario',
        'estadoUsuario',
        'cepUsuario',
        'rgUsuario',
        'statusUsuario',
        'tipoUsuario',
        'descTipoSanguineo'
    ];

    // Campos que devem ser ocultos para arrays
    protected $hidden = [
        'senhaUsuario',
    ];
    
    // Caso o formato da data precise ser manipulado
    protected $dates = [
        'dataNascUsuario',
    ];
}

