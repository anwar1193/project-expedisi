<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    function render($request, Throwable $exception)
    {
        if ($request->is('api/*')) {
            if(!$request->bearerToken()){
                return response()->json(
                    [
                        'status' => 401,
                        'message' => 'Silahkan Login Terlebih Dahulu'
                    ],
                    401);
            } else {
                if (!Auth::guard('sanctum')->check()) {
                    return response()->json([
                        'status' => 401,
                        'message' => 'Token invalid'
                    ], 401);
                }
            }
        }
        
        if ($this->isHttpException($exception)) {
            if ($exception->getStatusCode() == 404) {
                return response()->view('errors.404', [], 404);
            }
            if ($exception->getStatusCode() == 500) {
                return response()->view('errors.500', [], 500);
            }
        }
        return parent::render($request, $exception);
     }

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
