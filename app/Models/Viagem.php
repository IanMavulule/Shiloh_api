<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Viagem extends Model
{
    protected $fillable = [
        'nome_viagem',
        'localizacao',
        'nr_participantes',
        'nr_viaturas'
    ];


    public function carros()
    {
        return $this->hasMany(Carro::class, 'id_viagem');
    }
}
