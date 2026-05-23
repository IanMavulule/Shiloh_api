<?php

namespace App\Services;

use App\Models\Participante;
use App\Models\Carro;
use Illuminate\Support\Facades\DB;
use App\Services\ViagemService;


class ParticipanteService 
{
    protected $viagemService;

    public function __construct(ViagemService $viagemService)
    {
        $this->viagemService = $viagemService;
    }

    public function createParticipante(array $data)
    {
        return DB::transaction(function () use ($data) {

            $carroId = $this->getOrCreateCarro(1);
            $participante = Participante::create(array_merge($data, [
                'id_carro' => $carroId
            ]));

            $viagem = $this->viagemService->getViagemById(1);

            $viagem->increment('nr_participantes');

            return $participante;
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


        $viagem = $this->viagemService->getViagemById(1);

        $viagem->increment('nr_viaturas');

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