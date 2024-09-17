<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoneUsuario extends Model
{
    use HasFactory;

    protected $table = 'tbFoneUsuario';

    protected$primaryKey = 'idFoneUsuario';

    protected $fillable = [
        'numFoneUsuario',
        'idUsuario',
        'idTelefone'
    ];

    public function usuario(){
        return $this->belongsTo(Usuario::class, 'idUsuario');
    }

    public function telefone(){
        return $this->belongsTo(Telefone::class, 'idTelefone');
    }
}
