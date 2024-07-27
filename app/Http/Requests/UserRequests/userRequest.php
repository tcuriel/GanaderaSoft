<?php

namespace App\Http\Requests\UserRequests;

use Illuminate\Foundation\Http\FormRequest;

class userRequest extends FormRequest
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
            'usuario.email' => 'email:rfc,dns',
            'usuario.password' => 'min:4|max:8|confirmed',
            'usuario.tipo_Usuario' => 'in:Propietario,Transcriptor Ingeniero,Transcriptor Veterinario,Transcriptor Asistente',
            'usuario.Nombre' => 'alpha:ascii',
            'usuario.Apellido' => 'alpha:ascii',
            'usuario.Telefono' => 'numeric|digits_between:10,15'
        ];
    }
}
