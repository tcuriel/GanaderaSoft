<?php

namespace App\Http\Requests\FincaRequests;

use Illuminate\Foundation\Http\FormRequest;

class Movimiento extends FormRequest
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
              'movimiento.id_Finca' => 'numeric',
              'movimiento.id_Rebano' => 'numeric',
              'movimiento.Rebano_Destino' => 'string',
              'movimiento.id_Finca_Destino' => 'numeric',
              'movimiento.id_Rebano_Destino' => 'numeric',
              'movimiento.Comentario' => 'string|max:40',
              'movimiento.Motivo' => 'string|max:10',
              'movimiento.Tipo' => 'string||max:10',
              'movimiento.cantidad' => 'string||max:10',
        ];
    }

    public function withValidator($validator)
    {
        $validator->setCustomMessages([
            'movimiento.id_Finca.numeric' => 'El campo id finca debe ser un numero',
            'movimiento.id_Rebano.numeric' => 'El campo id rebaño debe ser un numero',
            'movimiento.Rebano_Destino.string' => 'El campo rebaño destino debe ser una cadena de caracteres',
            'movimiento.id_Finca_Destino.numeric' => 'El campo id finca destino debe ser un numero',
            'movimiento.id_Rebano_Destino.numeric' => 'El campo id rebaño destino debe ser un numero',
            'movimiento.Comentario.string' => 'El campo comentario debe ser una cadena de caracteres',
            'movimiento.Comentario.max:40' => 'El campo comentario debe tener como maximo :max caracteres',
            'movimiento.Motivo.string' => 'El campo motivo debe ser una cadena de caracteres',
            'movimiento.Motivo.max:10' => 'El campo motivo debe tener como maximo :max caracteres',
            'movimiento.Tipo.string' => 'El campo debe ser una cadena de caracteres',
            'movimiento.Tipo.max:10' => 'El campo debe tener como maximo :max caracteres',
            'movimiento.cantidad.string' => 'El campo debe ser una cadena de caracteres',
            'movimiento.cantidad.max:10' => 'El campo debe tener como maximo :max caracteres',
        ]);
    }
}
