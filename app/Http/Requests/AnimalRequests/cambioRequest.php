<?php

namespace App\Http\Requests\AnimalRequests;

use Illuminate\Foundation\Http\FormRequest;

class CambioRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cambio.Fecha_Cambio' => 'required|date|before_or_equal:today',
            'cambio.Etapa_Cambio' => 'required|max:10',
            'cambio.Peso' => 'required|numeric|min:0.01',
            'cambio.Altura' => 'required|numeric|min:0.01',
            'cambio.Comentario' => 'required|string|max:60',
            'animal.Edad' => 'required|numeric|min:0.01'
        ];
    }
}
