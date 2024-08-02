<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'localizacao',
        'horarioFuncionamento',
        'diaFuncionamento',
        'servicos',
        'latitude',
        'longitude'
    ];
}
