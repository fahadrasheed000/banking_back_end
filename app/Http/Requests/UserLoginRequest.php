<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
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
    public function rules()
    {
        return [
            'email' => 'required|email|max:255',
            'password' => 'required|min:8',
        ];
    }
    public function messages()
    {
        return [
            'password.min' => 'Password length must br greater than 8',
        ];
    }
}
