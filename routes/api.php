<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\ViagemController;
use App\Http\Controllers\api\v1\CarroController;
use App\Http\Controllers\api\v1\ParticipanteController;
use App\Http\Controllers\api\v1\PagamentoController;
use App\Http\Controllers\api\v1\AuthController;


Route::post('/adicionar-participante', [ParticipanteController::class, 'storeValidated']);
Route::post('/pagamentos', [PagamentoController::class, 'pagamento']);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/viagem', ViagemController::class);
    Route::apiResource('/carro', CarroController::class);
    Route::apiResource('/participante', ParticipanteController::class);

    Route::post('/logout', [AuthController::class, 'logout']);

});