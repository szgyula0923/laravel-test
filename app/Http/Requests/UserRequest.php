<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'first_name' => 'bail|required|max:255',
            'last_name'  => 'bail|required|max:255',
            'fb_link'    => 'bail|required|max:255',
            'password'   => 'bail|required|between:8,32',
            'email'      => 'bail|required|email|unique:users',
            'birth_date' => 'bail|required|size:10',
            'active'     => 'bail|required|boolean',
            'admin'      => 'bail|required|boolean'
        ];
    }
}
