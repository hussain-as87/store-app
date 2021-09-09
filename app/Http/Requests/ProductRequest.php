<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name.*' => 'required|max:200',
            'description.*' => 'sometimes|max:2000',
            'image' => 'sometimes|file|image',
            'gallery.*' => 'sometimes|file|image',
            'price' => 'required|max:1000000000',
            'category_id' => 'required',
            'gallery' => 'sometimes|max:1000000000',
        ];
    }

    /*  public function messages()
    {
        return [
            'required' => 'this field is require !!!'
        ];
    }*/

    /*    public function attributes()
    {
        return [
            'name.*' => 'product name',
            'description.*' => 'product description',
            'image' => 'product image',
            'gallery.*' => 'product gallery',
            'price' => 'product price',
            'category_id' => 'product category_id',
            'gallery' => 'product gallery',
        ];
    }*/
}
