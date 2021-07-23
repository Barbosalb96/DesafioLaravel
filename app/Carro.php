<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    protected $table = 'carros';
    protected $fillable = [
        'nome',
        'url',
        'ano',
        'combustivel',
        'portas',
        'quilometagem',
        'cambio',
        'cor',
    ];
}
