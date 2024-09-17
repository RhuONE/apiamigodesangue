<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    use HasFactory;

    protected $table = 'tbTelefone';

    protected $primaryKey = 'idTelefone';

    protected $fillable = ['numTelefone'];
}
