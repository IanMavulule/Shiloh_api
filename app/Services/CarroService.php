<?php

namespace app\Services;

use App\Models\Carro;
use App\Models\Participante;

class CarroService 
{
    public function createCarro(array $data) {
        return Carro::create($data);
    }

    public function getAllCarros()
    {
        return Carro::all();
    }

    public function getCarroById(int $id)
    {
        return Carro::findOrfail($id);
    }

    public function updateCarro(String $id, array $data): Carro
    {
        $carro = Carro::findOrFail($id);
        $carro->update($data);
        return $carro;
    }

    public function deleteCarro(String $id): void
    {
       
        $carro = Carro::findOrFail($id);
        $carro->delete();
    }


}