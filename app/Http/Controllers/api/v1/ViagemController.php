<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;

use App\Models\Viagem;
use App\Services\ViagemService;
use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Viagem\StoreViagem;
use App\Http\Requests\Viagem\UpdateViagem;

class ViagemController extends Controller
{
    use ApiResponse;

    protected $viagemService;

    public function __construct(ViagemService $viagemService)
    {
        $this->viagemService = $viagemService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $viagens = $this->viagemService->getAllViagens();
            return $this->success($viagens);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(StoreViagem $request)
    {
        try {
            $viagens = $this->viagemService->createViagem($request->validated());
            return $this->success($viagens);
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
            $viagens = $this->viagemService->getViagemById($id);
            return $this->success($viagens);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateViagem $request, String $id)
    {
        try {
            $viagens = $this->viagemService->updateViagem($id, $request->validated());
            return $this->success($viagens);
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
            $viagens = $this->viagemService->deleteViagem($id);
            return $this->success($viagens);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
