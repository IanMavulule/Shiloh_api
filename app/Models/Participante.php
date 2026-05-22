<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    protected $fillable = [
        "nome",
        "apelido",
        "data_nascimento",
        "genero",
        "turma",
        "bairro",
        "nr_celular01",
        "nr_celular02",
        "id_viagem",
        "id_carro",
    ];

    public function carro()
    {
        return $this->belongsTo(Carro::class, 'id_carro');
    }
}
