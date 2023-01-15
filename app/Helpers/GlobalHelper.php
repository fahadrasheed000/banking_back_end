<?php

use App\Models\UserAccount;
use Illuminate\Support\Facades\DB;

function addOrRemoveUserBalance($userId, $accountId, $amount, $tag)
{
    if ($tag == "Add") {
        $data = array('balance' => DB::raw('balance +' . $amount));
    } else {
        $data = array('balance' => DB::raw('balance -' . $amount));
    }
    $response = UserAccount::where('user_id', $userId)->where('account_id', $accountId)->update($data);
    return $response;
}
