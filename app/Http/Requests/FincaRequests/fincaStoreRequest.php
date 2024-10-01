<?php

namespace App\Http\Requests\FincaRequests;

use Illuminate\Foundation\Http\FormRequest;

class FincaStoreRequest extends FormRequest
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
    public function rules(): array //metodo para validar los datos de crear finca
    {
        $exploitations = config('app.explotacion');
        $relievesuelo = config('app.relieve-suelo');
        $metodoriego = config('app.metodo-riego');
        $texturasuelo = config('app.textura-suelo');
        $fuenteagua = config('app.fuente-agua');
        $exploitationsRules = [];
        $relievesueloRules = [];
        $metodoriegoRules = [];
        $texturasueloRules = [];
        $fuenteaguaRules = [];
        
        foreach ($exploitations as $exploitation) {
            $exploitationsRules[] = $exploitation;
        }
        foreach ($relievesuelo as $relieve) {
            $relievesueloRules[] = $relieve;
        }
        foreach ($metodoriego as $metodo) {
            $metodoriegoRules[] = $metodo;
        }
        foreach ($texturasuelo as $textura) {
            $texturasueloRules[] = $textura;
        }
        foreach ($fuenteagua as $fuente) {
            $fuenteaguaRules[] = $fuente;
        }

        return [
            //valida los dato de finca
            'finca.Nombre' => 'required|max:25',
            'finca.Explotacion_Tipo' => 'required|in:' . implode(',', $exploitationsRules),
            //valida los datos de hierro
            //'hierro' => 'nullable|array',
            //'hierro.Hierro_Imagen' => 'nullable|mimes:jpeg,jpg,png',
            //'hierro.Hierro_QR' => 'nullable|mimes:jpeg,jpg,png',
            'hierro.identificador' => 'string|size:10',
           //valida los datos de terreno
            'terreno.ph_Suelo' => 'nullable|numeric|in:1,2,3,4,5,6,7',
            'terreno.Relieve' => 'nullable|string|in:' . implode(',', $relievesueloRules),
            'terreno.Riego_Metodo' => 'nullable|string|in:' . implode(',', $metodoriegoRules),
            'terreno.Suelo_Textura' => 'nullable|string|in:' . implode(',', $texturasueloRules),
            'terreno.Fuente_Agua' => 'nullable|string|in:' . implode(',', $fuenteaguaRules),
            'terreno.Superficie' => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'terreno.Precipitacion' => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'terreno.Velocidad_Viento' => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'terreno.Temp_Anual' => 'nullable|regex:/^\d{1,2}+(\.\d{1})?$/',
            'terreno.Temp_Min' => 'nullable|numeric|regex:/^\d{1,2}+(\.\d{1})?$/',
            'terreno.Temp_Max' => 'nullable|numeric|regex:/^\d{1,2}+(\.\d{1})?$/',
            'terreno.Radiacion' => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'terreno.Caudal_Disponible' => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/'
            
        ];
    }

    public function withValidator($validator)
    {
        $exploitations = config('app.explotacion');
        $exploitationsRules = [];

        foreach ($exploitations as $exploitation) {
            $exploitationsRules[] = $exploitation;
        }

        $validator->setCustomMessages([
            'finca.Nombre.required' => 'El campo Nombre es obligatorio',
            'finca.Nombre.max:25' => 'El campo no debe sobrepasar los 25 caracteres',
            'finca.Nombre.regex:/^[A-Za-z\s\d]+$/' => 'El campo solo debe tener caracteres alfabeticos',
            'finca.Explotacion_Tipo.required' => 'El campo explotacion es obligatorio',
            'finca.Explotacion.in:' . implode(',', $exploitationsRules) => 'El campo debe estar entre: ' . implode(',', $exploitationsRules),

            'hierro.Hierro_Imagen.mimes:jpeg,jpg,png' => 'La imagen debe ser en formato jpeg, jpg o png',
            'hierro.Hierro_QR.mimes:jpeg,jpg,png' => 'La imagen debe ser en formato jpeg, jpg o png',
            'hierro.identificador.string' => 'el campo debe ser una cadena de caracteres',
            'hierro.identificador.size:10' => 'el campo debe tener un tamaño de 10 caracteres',

            'terreno.Superficie.numeric' => 'El campo debe ser un número.',
            'terreno.Superficie.regex' => 'El campo debe tener como máximo dos decimales.',
            'terreno.Relieve.string' => 'El campo debe ser una cadena de texto.',
            'terreno.Relieve.in' => 'El campo debe ser uno de los siguientes: :values.',
            'terreno.Suelo_Textura.string' => 'El campo debe ser una cadena de texto.',
            'terreno.ph_Suelo.numeric' => 'El campo debe ser un número.',
            'terreno.ph_Suelo.in' => 'El campo debe estar entre :values.',
            'terreno.Precipitacion.numeric' => 'El campo debe ser un número.',
            'terreno.Precipitacion.regex' => 'El campo debe tener como máximo dos decimales.',
            'terreno.Velocidad_Viento.numeric' => 'El campo debe ser un número.',
            'terreno.Velocidad_Viento.regex' => 'El campo debe tener como máximo dos decimales.',
            'terreno.Temp_Anual.regex' => 'La temperatura anual debe tener como máximo dos decimales.',
            'terreno.Temp_Min.regex' => 'La temperatura mínima debe tener como máximo dos decimales.',
            'terreno.Temp_Max.regex' => 'La temperatura máxima debe tener como máximo dos decimales.',
            'terreno.Radiacion.numeric' => 'La radiación debe ser un número.',
            'terreno.Radiacion.regex' => 'La radiación debe tener como máximo dos decimales.',
            'terreno.Fuente_Agua.string' => 'La fuente de agua debe ser una cadena de texto.',
            'terreno.Fuente_Agua.max' => 'La fuente de agua no puede tener más de :max caracteres.',
            'terreno.Fuente_Agua.alpha' => 'La fuente de agua solo puede contener letras.',
            'terreno.Caudal_Disponible.numeric' => 'El campo debe ser un número.',
            'terreno.Caudal_Disponible.regex' => 'El campo debe ser un número y debe tener como máximo dos decimales.',
            'terreno.Riego_Metodo.string' => 'El campo debe ser una cadena de texto.',
            'terreno.Riego_Metodo.max' => 'El campo no puede tener más de :max caracteres.',
            'terreno.Riego_Metodo.alpha' => 'El campo solo puede contener letras.'
        ]);
    }
}
