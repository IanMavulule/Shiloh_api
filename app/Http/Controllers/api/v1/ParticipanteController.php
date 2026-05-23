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
use Illuminate\Support\Facades\Log;
use App\Models\PagamentoPendente;

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
        Log::info('CALLBACK RECEBIDO', $request->all());

        try {
            $event = $request->input('event');

            if ($event !== 'payment.success') {
                Log::info('Evento ignorado', ['event' => $event]);
                return response()->json(['message' => 'Ignorado'], 200);
            }

            $reference = $request->input('data.reference');
            Log::info('Reference recebida', ['reference' => $reference]);

            $pendente = PagamentoPendente::where('reference', $reference)->first();

            if (!$pendente) {
                Log::error('Reference não encontrada', ['reference' => $reference]);
                return response()->json(['message' => 'Reference não encontrada'], 200);
            }

            $metadata = $pendente->metadata; // já é array pelo cast

            Log::info('Metadata encontrado', ['metadata' => $metadata]);

            $participante = $this->participanteService->createParticipante($metadata);

            // Apagar após usar
            $pendente->delete();

            Log::info('Participante criado com sucesso', ['id' => $participante->id]);

            return $this->success([
                'participante' => $participante,
                'mensagem'     => 'Mais um participante inscrito'
            ]);

        } catch (\Exception $e) {
            Log::error('ERRO CALLBACK', ['erro' => $e->getMessage()]);
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
