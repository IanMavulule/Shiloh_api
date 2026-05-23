<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;

use App\Models\Participante;
use App\Services\ParticipanteService;
use App\Services\ViagemService;
use App\Http\Controllers\api\v1\ViagemController;
use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Participante\StoreParticipante;
use App\Http\Requests\Participante\UpdateParticipante;

class ParticipanteController extends Controller
{
    use ApiResponse;

    protected $participanteService;
    protected $viagemService;

    public function __construct(ParticipanteService $participanteService, ViagemService $viagemService)
    {
        $this->participanteService = $participanteService;
        $this->viagemService = $viagemService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $Participantes = $this->participanteService->getAllParticipantes();
            return $this->success($Participantes);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(StoreParticipante $request)
    {
        try {

            $participante = $this->participanteService->createParticipante($request->validated());

            return $this->success([
                'participante' => $participante,
                'mensagem' => 'Mais um participante inscrito'
            ]);

        } catch (\Exception $e) {

            return $this->error($e->getMessage());

        }
    }

        /**
     * Show the form for creating a new resource.
     */
    public function storeValidated(Request $request)
    {
        try {
            $metadata = $request->input('metadata');

            $participante = $this->participanteService->createParticipante($metadata);

            return $this->success([
                'participante' => $participante,
                'mensagem' => 'Mais um participante inscrito'
            ]);

        } catch (\Exception $e) {

            return $this->error($e->getMessage());

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        try {
            $Participantes = $this->participanteService->getParticipanteById($id);
            return $this->success($Participantes);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(StoreParticipante $request, String $id)
    {
        try {
            $Participantes = $this->participanteService->updateParticipante($id, $request->validated());
            return $this->success($Participantes);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        try {
            $Participantes = $this->participanteService->deleteParticipante($id);
            return $this->success($Participantes);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
