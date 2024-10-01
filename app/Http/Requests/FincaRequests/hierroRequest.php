<?php

namespace App\Http\Requests\FincaRequests;

use Illuminate\Foundation\Http\FormRequest;

class HierroRequest extends FormRequest
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
            //valida los datos de hierro
            //'hierro.Hierro_Imagen' => 'nullable|mimes:jpeg,jpg,png',
            //'hierro.Hierro_QR' => 'nullable|mimes:jpeg,jpg,png',
            'hierro.identificador' => 'nullable|string|size:10',
        ];
    }

    public function withValidator($validator)
    {
        $validator->setCustomMessages([
            //'hierro.Hierro_Imagen.mimes:jpeg,jpg,png' => 'La imagen debe ser en formato jpeg, jpg o png',
            //'hierro.Hierro_QR.mimes:jpeg,jpg,png' => 'La imagen debe ser en formato jpeg, jpg o png',
            'hierro.identificador.string' => 'el campo debe ser una cadena de caracteres',
            'hierro.identificador.size:10' => 'el campo debe tener un tamaño de 10 caracteres',

        ]);
    }
}
