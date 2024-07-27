<?php

namespace App\Http\Requests\AnimalRequests;

use Illuminate\Foundation\Http\FormRequest;

class razaRequest extends FormRequest
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
            'raza.Nombre' => 'required|max:30|regex:/^[A-Za-z\s\d]+$/',
            'raza.Siglas' => 'required|max:6',
            'raza.Pelaje' => 'required|max:80',
            'raza.Proposito' => 'required|in:Doble,Carne,Leche',
            'raza.Tipo_Raza' => 'required|max:12',
            'raza.Origen' => 'required|max:60',
            'raza.Caracteristica_Especial' => 'required|max:80',
            'raza.Proporcion_Raza' => 'required|in:Grande,Mediano,Pequeño'
        ];
    }
}
