<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\DepositsController;
use App\Http\Controllers\BankTranferController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => ['api']
], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
/***
 * jwt.validate middleware the validate request before going to controller
 * app/Http/Middleware/JwtMiddleware.php
 */
    Route::group(['middleware' => ['jwt.validate']], static function ($router) {
        //=================Bank===========================================
        Route::get('bank/get_banks', [BankController::class, 'getAllBanks']);
        //=================Verify beneficiary Account=================================
        Route::post('bank/account/verify', [BankAccountController::class, 'verifyUserAccount']);
        //=================Deposits===========================================
        Route::post('deposits/save_deposit', [DepositsController::class, 'addDeposit']);
         //=================Fund Transfer============================================
         Route::post('bank/transfer', [BankTranferController::class, 'transferFunds']);
        //==================User Logout====================================
        Route::post('logout', [AuthController::class, 'logout']);
    });
});
