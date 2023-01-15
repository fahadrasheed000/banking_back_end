<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTransferRequest extends FormRequest
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
            'from_account' => 'required',
            'to_account' => 'required',
            'amount' => 'required|numeric|between:0,9999999999.99'
        ];
    }
    public function messages()
    {
        return [
            'user_id.required' => 'User ID is required',
            'from_account.required' => 'Sender Account is required',
            'to_account.required' => 'Receiver Account is required',
            'amount.numeric' => 'Amount should be numbers only',
        ];
    }
}
