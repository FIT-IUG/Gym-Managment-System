<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePackageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required| min:3',
            'price' => 'required | numeric',
            'description' => 'required | min:9',
            'image' => 'required | file | mimes:jpg,jpeg,png'
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'id is required',
            'name.required' => 'name is required',
            'name.min' => 'name the minimum length is 3 chars.',
            'price.required' => 'price is required',
            'price.numeric' => 'price is number',
            'description.required' => 'description is required',
            'description.min' => 'description the minimum length is 9 chars.',
            'image.required' => 'image is required',
            'image.file' => 'image is file',

        ];
    }
}
