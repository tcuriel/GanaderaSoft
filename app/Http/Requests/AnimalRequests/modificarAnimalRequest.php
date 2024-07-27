<?php

namespace App\Http\Requests\AnimalRequests;

use Illuminate\Foundation\Http\FormRequest;

class modificarAnimalRequest extends FormRequest
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
            'animal.Nombre' => 'required|max:25|regex:/^[A-Za-z\s\d]+$/',
            'animal.Sexo' => 'required|in:M,F',
            'animal.Edad' => 'required|integer',
            'animal.Tipo' =>  'required|in:Vacuno,Bufala',
            'animal.Estado' => 'required|in:Sano,Enfermo,Muerto,Servicio,Preñez',
            'animal.Procedencia' => 'required|max:50',
        ];
    }
}
