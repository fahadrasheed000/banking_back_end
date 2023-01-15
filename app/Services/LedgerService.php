<?php

namespace App\Services;

use App\Models\Ledger;

class LedgerService
{
    /**
     * @param $userId int
     * @param $accountId int
     * @param $depositId int
     * @param $amount double
     * @return bool
     */
    function addDepositsIntoLedger($userId, $accountId, $depositId, $amount): bool
    {
        $data = array(
            'user_id' => $userId,
            'account_id' => $accountId,
            'deposit_id' => $depositId,
            'credit' => $amount
        );
        $ledger = Ledger::create($data);
        if ($ledger->id) {
            //Update user balance a helper function App\Helpers\GlobalHelper
            return  addOrRemoveUserBalance($userId, $accountId, $amount, 'Add');
        }
        return false;
    }
    /**
     * @param $userId int
     * @param $accountId int
     * @param $transferId int
     * @param $amount double
     * @return bool
     */
    function addTransfersIntoLedger($userId, $accountId, $transferId, $amount): bool
    {
        $data = array(
            'user_id' => $userId,
            'account_id' => $accountId,
            'transfer_id' => $transferId,
            'debit' => $amount
        );
        $ledger = Ledger::create($data);
        if ($ledger->id) {
            //Update user balance a helper function App\Helpers\GlobalHelper
            return  addOrRemoveUserBalance($userId, $accountId, $amount, 'Remove');
        }
        return false;
    }
}
