<?php

namespace App\Http\Requests\AnimalRequests;

use Illuminate\Foundation\Http\FormRequest;

class toroRequest extends FormRequest
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
            'toro.nombre' => 'required|max:25|regex:/^[A-Za-z\s\d]+$/',
            'toro.procedencia' => 'required|max:60'
            
        ];
    }
}
