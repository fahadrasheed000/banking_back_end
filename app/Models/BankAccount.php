<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserAccount;

class BankAccount extends Model
{
    use HasFactory;
    protected $fillable = ['account_number', 'bank_id'];

    /**
     * @param bankID integer
     * @param accountNo string
     * @return integer
     */
    function verifyAccountNo($bankID, $accountNo)
    {
        $result = BankAccount::select("id")
            ->where("bank_id", $bankID)
            ->where("account_number", $accountNo)
            ->get();
        $userAccountModel = new UserAccount();

        $accountId = count($result) > 0 ? $result[0]->id : false;
        if ($accountId) {
            $userAccountExists = $userAccountModel->getUserIdByAccountID($accountId);
            if ($userAccountExists) {
                return $accountId;
            }
        } else {
            return false;
        }
    }
}
