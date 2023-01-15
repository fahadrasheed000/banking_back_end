<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class CreateDepositRequest extends FormRequest
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
            'user_id' => 'required',
            'account_id' => 'required',
            'amount' => 'required|numeric|between:0,9999999999.99'
        ];
    }
    public function messages()
    {
        return [
         'user_id.required' => 'User ID is required',
         'account_id.required' => 'Account ID is required',
         'amount.required' => 'Amount is required',
         'amount.numeric' => 'Amount should be numbers only',
        ];
    }
}
