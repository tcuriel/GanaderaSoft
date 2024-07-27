<?php

namespace App\Http\Requests\csvRequests;

use Illuminate\Foundation\Http\FormRequest;

class csvRequest extends FormRequest
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
            //Sera nulo dependiendo de donde sea llamado
            'id_Propietario' => 'numeric',
            'id_Finca' => 'numeric',
            'id_Rebano' => 'numeric'
        ];
    }
}
