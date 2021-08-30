<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|max:255',
            'desc' => 'required',
            'price' => 'required|integer',
            'images' => 'array',
            'images.*' => 'mimes:jpg,jpeg,png,bmp|max:20000',
            'remove_images' => 'nullable|string'
        ];
    }
}
