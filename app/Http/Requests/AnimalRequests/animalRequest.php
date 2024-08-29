<?php

namespace App\Http\Requests\AnimalRequests;

use Illuminate\Foundation\Http\FormRequest;


class animalRequest extends FormRequest
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
            //animal
            'Nombre' => 'required|max:25|regex:/^[A-Za-z\s\d]+$/',
            'codigo_animal'=> 'nullable|max:20',
            'Sexo' => 'required|in:M,H',
            'fecha_nacimiento' => 'required|date',
            'etapa_animal' => 'required|numeric',
            'estado_salud' => 'required|numeric',
            'procedencia' => 'required|max:50',
            'rebaño'=> 'required|numeric',
            'raza' => 'required|numeric'
        ];
    }
}
