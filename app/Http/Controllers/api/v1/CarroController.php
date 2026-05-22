<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Carro;
use Illuminate\Http\Request;

use App\Services\CarroService;
use App\Services\ViagemService;
use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Carro\StoreCarro;


class CarroController extends Controller
{
    use ApiResponse;

    protected $CarroService;
    protected $viagemService;


    public function __construct(CarroService $carroService, ViagemService $viagemService)
    {
        $this->carroService = $carroService;
        $this->viagemService = $viagemService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $carros = $this->carroService->getAllCarros();
            return $this->success($carros);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(StoreCarro $request)
    {
        try {
            $carro = $this->carroService->createCarro($request->validated());

            $viagem = $this->viagemService
                ->getViagemById($carro->id_viagem);

            $viagem->increment('nr_viaturas');


            return $this->success([
                'carro' => $carro,
                'mensagem' => 'Mais um carro inscrito'
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
            $carros = $this->carroService->getCarroById($id);
            return $this->success($carros);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarro $request, String $id)
    {
        try {
            $carros = $this->carroService->updateCarro($id, $request->validated());
            return $this->success($carros);
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
            $carros = $this->carroService->deleteCarro($id);
            return $this->success($carros);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
