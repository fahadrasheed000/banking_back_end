<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|same:confirm_password',
        ];
    }
    public function messages()
    {
        return [
         'email.unique' => 'Email already exists. Please enter unique email',
         'name.required' => 'Name is required',
        'password.required' => 'Password is required',
        'confirm_password:same' => 'Password should be same',
        ];
    }
}
