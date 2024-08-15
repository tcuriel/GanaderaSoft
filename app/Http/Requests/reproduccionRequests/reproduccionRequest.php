<?php

namespace App\Http\Requests\reproduccionRequests;

use Illuminate\Foundation\Http\FormRequest;

class reproduccionRequest extends FormRequest
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
            'servicio_fecha'=> 'date',
            'servicio_tipo'=> 'required|in:Natural,Artificial',
            'servicio_observacion' => 'max:100',
            'servicio_id_Animal' => 'nullable|integer',
            'servicio_semen_id' => 'nullable|integer',
            'servicio_celo_id' => 'nullable|integer'
        ];
    }
}
