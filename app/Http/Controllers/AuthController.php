<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UserLoginRequest;


class AuthController extends Controller
{
    public $token = true;
    private $userObj;
    function __construct()
    {
        $this->userObj = new User();
    }
    /**
     * @param request validation object as dependency injection
     * @return json object
     */
    public function login(UserLoginRequest $request) : object
    {

        $jwt_token = null;
        $jwt_token = $this->userObj->authenticteUser($request);
        if (!$jwt_token) {
            /***
             * app/Helpers/ApiHelper.php
             * apiResponse a custom response function that return json response
             */
            return apiResponse([], 'errors', 'Invalid email or password', '', '');
        } else {
            $currentUser = Auth::user();
            return apiResponse(null, 'success', 'User successfully logged in', $jwt_token, auth()->user());
        }
    }
     /**
     * @param request  object as dependency injection
     * @return json object
     */
    public function logout(Request $request) : object
    {

        JWTAuth::invalidate($request->token);
         /***
             * app/Helpers/ApiHelper.php
             * apiResponse a custom response function that return json response
             */
        return apiResponse([], 'success', 'User successfully logged out', '', '');
    }
}
