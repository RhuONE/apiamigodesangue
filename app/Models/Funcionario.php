<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Funcionario extends Model
{
    use HasFactory;

    protected $table = 'tbFuncionario';

    protected $primaryKey = 'idFuncionario';

    protected $fillable = [

        //'fotoFuncionario',
        'nomeFuncionario',
        'cpfFuncionario',
        'descFuncionario',
        //'dataNascFuncionario',
        'emailFuncionario',
        //'senhaFuncionario',
        'statusFuncionario',
        'idHemocentro'
    ];

    public function hemocentro(){
        return $this->belongsTo(Hemocentro::class, 'idHemocentro');
    }

}

