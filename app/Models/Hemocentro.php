<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Hemocentro extends Model
{

    use HasFactory;
    use HasApiTokens;

    protected $table = 'tbHemocentro';

    protected $primaryKey = 'idHemocentro';
    
    protected $fillable = [
        'fotoHemocentro', 'nomeHemocentro', 'descHemocentro', 
        'telHemocentro', 'cepHemocentro', 'logHemocentro', 
        'numLogHemocentro', 'compHemocentro', 'bairroHemocentro', 
        'cidadeHemocentro', 'estadoHemocentro', 'emailHemocentro', 
        'senhaHemocentro', 'latitudeHemocentro', 'longitudeHemocentro', 
        'statusHemocentro'
    ];

    
    // Métodos adicionais para manipulação do status
    public function setStatusAtivo()
    {
        $this->statusHemocentro = 'ativo';
        $this->save();
    }

    public function setStatusArquivado()
    {
        $this->statusHemocentro = 'arquivado';
        $this->save();
    }

    public function setStatusPendente()
    {
        $this->statusHemocentro = 'pendente';
        $this->save();
    }
}