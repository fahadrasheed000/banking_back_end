<?php

namespace App\Http\Middleware;

use Closure;

use Tymon\JWTAuth\Facades\JWTAuth;

use Exception;

use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware

{


    public function handle($request, Closure $next)

    {

        try {

            $user = JWTAuth::parseToken()->authenticate();

            if (!$user) throw new Exception('User Not Found');
        } catch (Exception $e) {

            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {

                return apiResponse([], "errors", $e->getMessage(),  "", "");
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {

                return apiResponse([], "errors", $e->getMessage(),  "", "");
            } else {

                if ($e->getMessage() === 'User Not Found') {

                    return apiResponse([], "errors", $e->getMessage(),  "", "");
                }
                return apiResponse([], "errors", "Authorization token not foun",  "", "");
            }
        }

        return $next($request);
    }
}
