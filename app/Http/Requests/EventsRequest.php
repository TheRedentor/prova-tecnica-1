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
            'fecha' => 'required',
            'producto' => 'required',
            'numero' => 'required',
        ];
    }

    public function messages(){
        return [
            'fecha.required' => 'El campo fecha está vacio',
            'producto.required' => 'El campo producto está vacio',
            'numero.required' => 'El campo número está vacio',
        ];
    }
}
