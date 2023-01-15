<?php

namespace App\Exceptions;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;


class RequestExceptionHandler extends ExceptionHandler
{

    public function register()
{
    //exception handling by dependibot for specially 405 and 404
    $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
        return response()->json([
            'status' => 'error',
            'message' => 'Request Method not Allowed',
        ]);
    });

    $this->renderable(function (NotFoundHttpException $e, $request) {
        return response()->json([
            'status' => 'error',
            'message' => 'Requested page not found on server or moved.',
        ]);
    });


}

}
