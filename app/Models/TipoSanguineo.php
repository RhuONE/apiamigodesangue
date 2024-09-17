<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoSanguineo extends Model
{
    use HasFactory;

    //Nome da tabela
    protected $table = 'tbTipoSanguineo';

    protected $primaryKey = 'idTipoSanguineo';

    protected $fillable = ['descTipoSanguineo'];
}
