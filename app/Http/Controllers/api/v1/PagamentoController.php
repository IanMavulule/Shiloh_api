<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use App\Http\Requests\Participante\StoreParticipante;


class PagamentoController extends Controller
{
    public function pagamento(StoreParticipante $request)
    {
        $Participante = $request->validated();

        $metadata = [
            "nome" => $Participante['nome'],
            "apelido" => $Participante['apelido'],
            "data_nascimento" => $Participante['data_nascimento'],
            "genero" => $Participante['genero'],
            "turma" => $Participante['turma'],
            "bairro" => $Participante['bairro'],
            "nr_celular01" => $Participante['nr_celular01'],
            "nr_celular02" => $Participante['nr_celular02'],
        ];


        $ref = "Shiloh" . rand(100000, 999999);
        $payload = [
            "amount" => 20,
            "reference" => $ref,
            "description" => "Inscrição Shiloh",
            "return_url" => "https://artemaputo.com/reg1",
            "callback_url" => "https://api.tribo-juda.online/api/adicionar-participante",
            "metadata" => $metadata, 
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer 1983|yUUInxilzxiePHPzgE6NXXIv2kIWzFn358MSWV66bf5f67b7',
            'Content-Type' => 'application/json',
        ])
        ->timeout(15)
        ->post('https://paysuite.tech/api/v1/payments', $payload);

        return $response->json();
    }
}
