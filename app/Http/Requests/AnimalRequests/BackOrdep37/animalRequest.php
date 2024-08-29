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
            'animal.Nombre' => 'required|max:25|regex:/^[A-Za-z\s\d]+$/',
            'animal.Sexo' => 'required|in:M,F',
            'animal.Edad' => 'required|integer',
            'animal.Etapa' => 'required',
            'animal.Tipo' =>  'required|in:Vacuno,Bufala',
            'animal.Estado' => 'required|in:Sano,Enfermo,Muerto,Servicio,Preñez',
            'animal.Procedencia' => 'required|max:50',
            //Medidas
            'medida.Altura_HC' => 'nullable|numeric|min:0.01',
            'medida.Altura_HG' => 'nullable|numeric|min:0.01',
            'medida.Perimetro_PT' => 'nullable|numeric|min:0.01',
            'medida.Perimetro_PCA' => 'nullable|numeric|min:0.01',
            'medida.Longitud_LC' => 'nullable|numeric|min:0.01',
            'medida.Longitud_LG' => 'nullable|numeric|min:0.01',
            'medida.Anchura_AG' => 'nullable|numeric|min:0.01',
            //Indices
            'indice.Anamorfosis' => 'nullable|numeric',
            'indice.Corporal' => 'nullable|numeric',
            'indice.pelviano' => 'nullable|numeric',
            'indice.Proporcionalidad' => 'nullable|numeric',
            'indice.Dactilo_Toracico' => 'nullable|numeric',
            'indice.Pelviano_Transversal' => 'nullable|numeric',
            'indice.Pelviano_Longitudinal' => 'nullable|numeric',
            //|date|before_or_equal:today
            'peso.Fecha_Peso' => 'required',
            'peso.Peso' => 'required|numeric|min:0.01',
            'peso.Comentario' => 'nullable|string|max:40',
            'peso.Tipo' => 'in:Nacer,Destete,Actual',
            'peso.id_Tecnico' => 'nullable|numeric',
            //
            /*'composicion.id_Composicion' => 'numeric'*/
        ];
    }
}
