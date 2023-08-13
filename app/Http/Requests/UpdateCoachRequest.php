<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCoachRequest extends FormRequest
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

        $id = request()->all()['id'] ?? '';

        $validation = [
            'name' => ['required', 'min:3'],
            'profile_image' => ['required', 'file'],
            'description' => ['required', 'min:6'],

        ];


        return [
            'name' => 'required|min:3',
            'profile_image' => 'nullable',
            'description' => 'required|min:6',
            'password' => 'required|min:6|max:20',
            'confirmPassword' => 'required|same:password',

        ];
    }
}
