<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    use HasFactory;
    protected $fillable = ['account_id', 'user_id', 'balance'];

    /**
     * @param userID integer
     * @return array
     */
    function getUserAccount($userID)
    {
        $result = UserAccount::select("banks.name as bank_name", "bank_accounts.account_number", "user_accounts.account_id", "user_accounts.balance")
            ->join('bank_accounts', 'bank_accounts.id', '=', 'user_accounts.account_id')
            ->join('banks', 'banks.id', '=', 'bank_accounts.bank_id')
            ->where("user_accounts.user_id", $userID)
            ->get();
        return count($result) > 0 ? $result->toArray() : false;
    }
    /**
     * @param accountId integer
     * @return integer
     */
    function getUserIdByAccountID($accountId)
    {
        $result = UserAccount::select("user_id")
            ->where("account_id", $accountId)
            ->get();
        return count($result) > 0 ? $result[0]->user_id : false;
    }
}
