<?php

namespace App\Http\Requests\AnimalRequests;

use Illuminate\Foundation\Http\FormRequest;

class pesoRequest extends FormRequest
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
            'peso.Fecha_Peso' => 'required|date|before_or_equal:today',
            'peso.Peso' => 'required|numeric|min:0.01',
            'peso.Comentario' => 'string|max:40'
        ];
    }
}
