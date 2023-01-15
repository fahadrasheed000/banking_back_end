<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BankTranfer;
use App\Http\Requests\CreateTransferRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;

class BankTranferController extends Controller
{
    public $bankTranferModel = '';

    function __construct()
    {
        $this->bankTranferModel = new BankTranfer();
    }
    public function transferFunds(CreateTransferRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->bankTranferModel->saveBankTransfer($request->user_id, $request->from_account, $request->to_account, $request->amount);
            DB::commit();
            return apiResponse([], 'success', 'Successful', '', auth()->user());
        } catch (\Exception $e) {
            DB::rollBack();
            return apiResponse([], 'errors', $e->getMessage(), '');
        }
    }
}
