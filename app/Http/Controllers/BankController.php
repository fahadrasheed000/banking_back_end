<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use Tymon\JWTAuth\Facades\JWTAuth;

class BankController extends Controller
{
    public $bankModel;
    function __construct()
    {
        $this->bankModel = new Bank();
    }
    public function getAllBanks()
    {
        try {
            $banks = $this->bankModel->getAllBanksData();
            return apiResponse($banks, 'success', 'Successful', '', "");
        } catch (\Exception $e) {
            return apiResponse([], 'errors', $e->getMessage(), '');
        }
    }
}
