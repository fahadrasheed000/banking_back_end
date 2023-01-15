<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Http\Requests\CreateDepositRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;

class DepositsController extends Controller
{
    public $depsoitsModel = '';

    function __construct()
    {
        $this->depsoitsModel = new Deposit();
    }
    public function addDeposit(CreateDepositRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->depsoitsModel->saveDeposit($request->user_id, $request->account_id, $request->amount);
            DB::commit();
            return apiResponse([], 'success', 'Successful', '', auth()->user());
        } catch (\Exception $e) {
            DB::rollBack();
            return apiResponse([], 'errors', $e->getMessage(), '');
        }
    }
}
