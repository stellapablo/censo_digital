<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSaludFormRequest extends FormRequest
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
            'altura' => 'required',
            'peso' => 'required',

        ];
    }


    public function messages()
    {
        return  [
            'altura.required'=> 'Altura es obligatorio',
            'peso.required' => 'Peso es obligatorio',

        ];
    }
}
