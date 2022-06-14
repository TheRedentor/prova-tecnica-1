<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProductsRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
            'categoria' => 'required',
            'subcategoria' => 'required',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'El campo nombre está vacio',
            'description.required' => 'El campo descripción está vacio',
            'image.required' => 'El campo imagen está vacio',
            'categoria.required' => 'El campo categoria está vacio',
            'subcategoria.required' => 'El campo subcategoria está vacio',
        ];
    }
}
