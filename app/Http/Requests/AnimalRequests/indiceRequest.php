<?php

namespace App\Http\Requests\AnimalRequests;

use Illuminate\Foundation\Http\FormRequest;

class indiceRequest extends FormRequest
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
            'indice.Anamorfosis' => 'nullable|numeric|min:0.01',
            'indice.Corporal' => 'nullable|numeric|min:0.01',
            'indice.pelviano' => 'nullable|numeric|min:0.01',
            'indice.Proporcionalidad' => 'nullable|numeric|min:0.01',
            'indice.Dactilo_Toracico' => 'nullable|numeric|min:0.01',
            'indice.Pelviano_Transversal' => 'nullable|numeric|min:0.01',
            'indice.Pelviano_Longitudinal' => 'nullable|numeric|min:0.01',
        ];
    }
}
