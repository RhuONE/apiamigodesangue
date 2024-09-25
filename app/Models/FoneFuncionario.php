<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoneFuncionario extends Model
{
    use HasFactory;

    protected $table = 'tbFoneFuncionario';

    protected $primaryKey = 'idFoneFuncionario';

    protected $fillable = [
        'numFoneFuncionario',
        'idFuncionario',
        'idTelefone'
    ];

    public function funcionario(){
        return $this->belongsTo(Funcionario::class, 'idFuncionario');
    }

    public function telefone(){
        return $this->belongsTo(Telefone::class, 'idTelefone');
    }

}
