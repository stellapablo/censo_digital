<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RevistaFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'area_id' => 'required|exists:areas,are_nro',
            'reloj_id' => 'required'
        ];
    }

    public function messages()
    {
        return  [
            'area_id.unique'=> 'Debe seleccionar un area valida',
            'area_id.required'=> 'Debe seleccionar un area',
            'reloj_id.required'=> 'Debe seleccionar un reloj',

        ];
    }
}
