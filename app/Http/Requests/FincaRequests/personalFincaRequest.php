<?php

namespace App\Http\Requests\FincaRequests;

use Illuminate\Foundation\Http\FormRequest;

class personalFincaRequest extends FormRequest
{
    const CEDULA_REGEX = '/^.(VEJPG|vejpg){0,1}-(\d{0,8})(?:-(?:\d{1}))?$/';
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
            'personal_finca.Cedula' => ['required', 'unique:Personal_Finca,Cedula', 'regex:' . self::CEDULA_REGEX],
            'personal_finca.Nombre' => 'required|string|max:25',
            'personal_finca.Apellido' => 'required|string|max:25',
            'personal_finca.Telefono' => 'required|numeric|digits_between:10,15',
            'personal_finca.Telefono.numeric' => 'El numero de telefono solo debe poseer numeros',
            'personal_finca.Telefono.digits_between:10,15' => 'El número telefonico debe estar entre 10 a 15 digitos',
            'personal_finca.Correo' => 'required|email:rfc',
            'personal_finca.Tipo_Trabajador' => 'required|string|max:20'
        ];
    }

    public function withValidator($validator)
{
    $validator->setCustomMessages([
        'personal_finca.Cedula.required' => 'El campo ID debe es obligatorio',
        'personal_finca.Cedula.regex' => 'El formato de la cédula no es válido.',
        'personal_finca.Nombre.required' => 'El campo nombre es obligatorio.',
        'personal_finca.Nombre.max:25' => 'Debe estar compuesto por 25 caracteres como maximo',
        'personal_finca.Apellido.required' => 'El campo apellido es obligatorio.',
        'personal_finca.Apellido.max:25' => 'Debe estar compuesto por 25 caracteres como maximo',
        'personal_finca.Telefono.required' => 'El campo numero de telefono es obligatorio',
        'personal_finca.Telefono.numeric' => 'El numero de telefono solo debe poseer numeros',
        'personal_finca.Telefono.digits_between:10,15' => 'El número telefonico debe estar entre 10 a 15 digitos',
        'personal_finca.Correo.required' => 'El campo correo es obligatorio',
        'personal_finca.Correo.email:rfc' => 'El correo debe cumplir con el patron',
        'personal_finca.Tipo_Trabajador.required' => 'El campo Tipo de trabajador es obligatorio',
        'personal_finca.Tipo_Trabajador.max:20' => 'El campo debe poser maximo 20 caracteres',

    ]);
}
}
