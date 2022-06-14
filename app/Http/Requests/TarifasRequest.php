<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TarifasRequest extends FormRequest
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
            'start_date' => 'required',
            'end_date' => 'required',
            'price' => 'required',
        ];
    }

    public function messages(){
        return [
            'start_date.required' => 'El campo fecha de inicio de tarifa está vacio',
            'end_date.required' => 'El campo fecha de finalización de tarifa está vacio',
            'price.required' => 'El campo precio está vacio',
        ];
    }
}
