<?php

namespace App\Http\Requests\Viagem;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateViagem extends FormRequest
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
            'nome_viagem' => 'sometimes|string',
            'localizacao' => 'sometimes|string',
            'nr_participantes' => 'sometimes|numeric',
            'nr_viaturas' => 'sometimes|numeric'
        ];
    }
}
