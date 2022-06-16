<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventsRequest extends FormRequest
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
            'fecha' => 'required|date',
            'producto' => 'required',
            'numero' => 'required|integer',
        ];
    }

    public function messages(){
        return [
            'fecha.required' => 'El campo fecha está vacio',
            'producto.required' => 'El campo producto está vacio',
            'numero.required' => 'El campo número está vacio',
            'fecha.date' => 'El campo fecha no es una fecha',
            'numero.integer' => 'El campo número no es un número'
        ];
    }
}
