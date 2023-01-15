<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use Tymon\JWTAuth\Facades\JWTAuth;

class BankAccountController extends Controller
{
    public $bankAccountModel;
    function __construct()
    {
        $this->bankAccountModel = new BankAccount();
    }
    public function verifyUserAccount(Request $request)
    {
        try {
            $accountID = $this->bankAccountModel->verifyAccountNo($request->bank_id, $request->account_no);
            if ($accountID) {
                return apiResponse(['account_id' => $accountID], 'success', 'Successful', '', "");
            } else {
                return apiResponse([], 'errors', 'Sorry, Invalid user', '');
            }
        } catch (\Exception $e) {
            return apiResponse([], 'errors', $e->getMessage(), '');
        }
    }
}
