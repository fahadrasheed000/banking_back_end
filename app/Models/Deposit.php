<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\LedgerService;

class Deposit extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['user_id', 'account_id', 'amount'];
    /**
     * @param $userId int
     * @param $accountId int
     * @param $amount double
     * @return bool
     */
    function saveDeposit($userId, $accountId, $amount): bool
    {
        $data = array(
            'user_id' => $userId,
            'account_id' => $accountId,
            'amount' => $amount
        );

        $deposit = Deposit::create($data);
        if ($deposit->id) {
            $service = new LedgerService(); //service that handle ledger enteries
            return  $service->addDepositsIntoLedger($userId, $accountId, $deposit->id, $amount);
        }
        return false;
    }
}
