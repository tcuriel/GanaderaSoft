<?php

namespace App\Http\Requests\FincaRequests;

use Illuminate\Foundation\Http\FormRequest;

class movimiento_rebanoRequest extends FormRequest
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
                'movimiento.motivo' => 'max:10',
                'movimiento.comentario' => 'max:40',
                'movimiento.ids' => 'array',
                'movimiento.ids.*' => 'numeric'
        ];
    }

    public function withValidator($validator)
    {
        $validator->setCustomMessages([
            'movimiento.motivo.max:10' => 'El campo debe contener :max carcteres',
            'movimiento.comentario.max:40' => 'El campo debe contener :max carcteres',
            'movimiento.ids.*.numeric' => 'El campo debe ser numerico',
            'movimiento.ids.array' => 'El campo debe ser un array'
        ]);
    }
}
