<?php

use App\Models\UserAccount;

function apiResponse($data, $status, $message, $token = "", $user = null)
{
    $response = [];
    $response['status'] = $status;
    $response['message'] = $message;
    if ($user) {
        $allRoles = [];
        $response['current_user'] = $user->only(['id', 'name', 'email']);
        $response['account'] = getUserAccountDetail($user->id);
        $roles = $user->roles;
        if (!empty($roles)) :
            foreach ($roles as $role) {
                $allRoles[] = $role->only(['name']);
            }
            $response['current_user']['roles'] = $allRoles;
        endif;
    }
    $response['data'] = $data;
    if ($token) {
        return  response()->json($response)->header('Authorization', "bearer " . $token);
    } else {
        return  response()->json($response);
    }
}

function getUserAccountDetail($userID)
{
    $userAccountModel = new UserAccount();
    return $userAccountModel->getUserAccount($userID);
}
