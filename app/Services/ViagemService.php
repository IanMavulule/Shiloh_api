<?php

namespace app\Services;

use App\Models\Viagem;

class ViagemService 
{
    public function createViagem(array $data) {
        return Viagem::create($data);
    }

    public function getAllViagens()
    {
        return Viagem::with([
            'carros.participantes'
        ])->get();
    }

    public function getViagemById(int $id)
    {
        return Viagem::findOrfail($id);
    }

    public function updateViagem(String $id, array $data): Viagem
    {
        $viagem = Viagem::findOrFail($id);
        $viagem->update($data);
        return $viagem;
    }

    public function deleteViagem(String $id): void
    {
       
        $viagem = Viagem::findOrFail($id);
        $viagem->delete();
    }
}