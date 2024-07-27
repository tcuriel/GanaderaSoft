<?php

namespace App\Http\Requests\AnimalRequests;

use Illuminate\Foundation\Http\FormRequest;

class MedidasRequest extends FormRequest
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
            'medida.Altura_HC' => 'nullable|numeric|min:0.01',
            'medida.Altura_HG' => 'nullable|numeric|min:0.01',
            'medida.Perimetro_PT' => 'nullable|numeric|min:0.01',
            'medida.Perimetro_PCA' => 'nullable|numeric|min:0.01',
            'medida.Longitud_LC' => 'nullable|numeric|min:0.01',
            'medida.Longitud_LG' => 'nullable|numeric|min:0.01',
            'medida.Anchura_AG' => 'nullable|numeric|min:0.01',
        ];
    }
}
