<?php

namespace App\Http\Requests\Carro;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCarro extends FormRequest
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
            'matricula' => 'string',
            'cor' => 'string',
            'nome_motorista' => 'string',
            'nr_motorista' => 'string',
            'marca' => 'string',
            'modelo' => 'string',
            'id_viagem' => 'nullable|exists:viagems,id',
        ];
    }
}
