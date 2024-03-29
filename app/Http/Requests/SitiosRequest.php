<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SitiosRequest extends FormRequest
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
            'name' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'El campo nombre está vacio',
            'latitude.required' => 'El campo latitud está vacio',
            'longitude.required' => 'El campo longitud está vacio',
            'name.string' => 'El campo nombre no es un texto',
            'latitude.numeric' => 'El campo descripción no es un número',
            'longitude.numeric' => 'El campo longitud no es un número',
        ];
    }
}
