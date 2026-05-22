<?php

namespace App\Services;

use App\Models\Participante;
use App\Models\Carro;
use Illuminate\Support\Facades\DB;

class ParticipanteService 
{
    public function createParticipante(array $data)
{
    return DB::transaction(function () use ($data) {

        $carroId = $this->getOrCreateCarro(1);

        return Participante::create(array_merge($data, [
            'id_viagem' => 1,
            'id_carro' => $carroId
        ]));
    });
}

    public function getOrCreateCarro($viagemId)
    {
        $carro = Carro::where('id_viagem', $viagemId)
            ->withCount('participantes')
            ->having('participantes_count', '<', 17)
            ->orderBy('id')
            ->first();

        if ($carro) {
            return $carro->id;
        }

        return Carro::create([
            'id_viagem' => $viagemId
        ])->id;
    }

    public function getAllParticipantes()
    {
        return Participante::all();
    }

    public function getParticipanteById(int $id)
    {
        return Participante::findOrfail($id);
    }

    public function updateParticipante(String $id, array $data): Participante
    {
        $participante = Participante::findOrFail($id);
        $participante->update($data);
        return $participante;
    }

    public function deleteParticipante(String $id): void
    {
       
        $participante = Participante::findOrFail($id);
        $participante->delete();
    }
}