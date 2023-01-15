<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\LedgerService;
use App\Models\UserAccount;
use App\Models\Deposit;

class BankTranfer extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['user_id', 'from_account', 'to_account', 'amount'];
    /**
     * @param $userId int
     * @param $accountId int
     * @param $amount double
     * @return bool
     */
    function saveBankTransfer($userId, $fromAccount, $toAccount, $amount): bool
    {
        $data = array(
            'user_id' => $userId,
            'from_account' => $fromAccount,
            'to_account' => $toAccount,
            'amount' => $amount
        );
        $transfer = BankTranfer::create($data);
        if ($transfer->id) {
            $userAccountModel = new UserAccount();
            $receiverID = $userAccountModel->getUserIdByAccountID($toAccount);
            //=====Deposit amount in receiver's account
            $depositModel = new Deposit();
            $response = $depositModel->saveDeposit($receiverID, $toAccount, $amount);
            if ($response) {
                //=====withdraw amount from sender's account
                $service = new LedgerService(); //service that handle ledger enteries
                return  $service->addTransfersIntoLedger($userId, $fromAccount, $transfer->id, $amount);
            }
        }
        return false;
    }
}
