<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\ViagemController;
use App\Http\Controllers\api\v1\CarroController;
use App\Http\Controllers\api\v1\ParticipanteController;
use App\Http\Controllers\api\v1\PagamentoController;

Route::apiResource('/viagem', ViagemController::class);
Route::apiResource('/carro', CarroController::class);
Route::apiResource('/participante', ParticipanteController::class);
Route::post('/pagamentos', [PagamentoController::class, 'pagamento']);
