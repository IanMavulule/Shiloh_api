<?php

namespace App\Http\Requests\Participante;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreParticipante extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'sometimes|string',
            'apelido' => 'sometimes|string',
            'data_nascimento' => 'sometimes|string',
            'genero' => 'sometimes|string',
            'turma' => 'sometimes|string',
            'bairro' => 'sometimes|string',
            'nr_celular01' => 'sometimes|numeric',
            'nr_celular02' => 'sometimes|numeric',
            'id_carro' => 'sometimes|exists:viagems,id',
        ];
    }
}
