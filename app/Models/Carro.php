<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
   protected $fillable = [
        'matricula',
        'cor',
        'nome_motorista',
        'nr_motorista',
        'marca',
        'modelo',
        'id_viagem'
   ]; 

   public function viagem()
   {
      return $this->belongsTo(Viagem::class, 'id_viagem');
   }

   public function participantes()
   {
      return $this->hasMany(Participante::class, 'id_carro');
   }
}

