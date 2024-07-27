<?php

namespace App\Http\Requests\AnimalRequests;

use Illuminate\Foundation\Http\FormRequest;

class arbolRequest extends FormRequest
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
            'arbol.Cod_pa' => 'nullable|numeric', //padre
            'arbol.Cod_Abo' => 'nullable|numeric', //abuelo padre
            'arbol.Cod_bisaAbo_p1' => 'nullable|numeric', //bisabuelo abuelo padre
            'arbol.Cod_bisaAbo_p2' => 'nullable|numeric', //bisabuela abuelo padre
            'arbol.Cod_aba_P' => 'nullable|numeric', //abuela padre
            'arbol.Cod_bisaAba_p1' => 'nullable|numeric', //bisabuelo abuela padre
            'arbol.Cod_bisaAba_p2' => 'nullable|numeric', //bisabuela abuela padre
            'arbol.Cod_ma' => 'nullable|numeric', //madre
            'arbol.Cod_abo_M' => 'nullable|numeric', //abuelo madre
            'arbol.Cod_bisaAbo_m1' => 'nullable|numeric', //bisabuelo abuelo madre
            'arbol.Cod_bisaAbo_m2' => 'nullable|numeric', //bisabuela abuelo madre
            'arbol.Cod_aba_M' => 'nullable|numeric', //abuela madre
            'arbol.Cod_bisaAba_m1' => 'nullable|numeric', //bisabuelo abuela madre
            'arbol.Cod_bisaAba_m2' => 'nullable|numeric' //bisabuela abuela madre
        ];
    }
}
