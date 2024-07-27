<?php

namespace App\Http\Requests\FincaRequests;

use Illuminate\Foundation\Http\FormRequest;

class fincaRequest extends FormRequest
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
        $exploitations = config('app.explotacion');
        $exploitationsRules = [];

        foreach ($exploitations as $exploitation) {
            $exploitationsRules[] = $exploitation;
        }

        return [
            //valida los dato de finca
            'finca.Nombre' => 'required|max:25',
            'finca.Explotacion_Tipo' => 'required|in:' . implode(',', $exploitationsRules),
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
            'finca.Explotacion.in:' . implode(',', $exploitationsRules) => 'El campo debe estar entre: ' . implode(',', $exploitationsRules)
        ]);
    }
}
