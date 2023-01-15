<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public $users = '';
    //initializing permissions for specific controller
    function __construct()
    {
        $this->users = new User();
    }
    public function getAllUsers()
    {
        try {
            $auth_check = JWTAuth::parseToken()->authenticate();
            if ($auth_check) {
                $users = $this->users->getAllUsers();
                return apiResponse($users, 'success', 'Successful', '', auth()->user());
            } else {
                return apiResponse([], 'errors', 'Sorry, token is an invalid', '');
            }
        } catch (\Exception $e) {
            return apiResponse([], 'errors',$e->getMessage(), '');
        }
    }
}
