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
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'price' => 'required|numeric',
        ];
    }

    public function messages(){
        return [
            'start_date.required' => 'El campo fecha de inicio de tarifa está vacio',
            'end_date.required' => 'El campo fecha de finalización de tarifa está vacio',
            'price.required' => 'El campo precio está vacio',
            'start_date.date' => 'El campo fecha de inicio de tarifa es una fecha',
            'end_date.date' => 'El campo fecha de finalización de tarifa no es una fecha',
            'price.numeric' => 'El campo precio no es un número',
        ];
    }
}
