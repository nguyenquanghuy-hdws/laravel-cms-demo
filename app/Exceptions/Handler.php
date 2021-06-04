<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
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

    public function render($request, Throwable $exception) {
        if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            return response()->json([
                'error' => 'Entry for '.str_replace('App\\', '', $exception->getModel()).' not found',
                'title' => 'Error',
                'message' => 'Record not found, please check again!'
            ], 404);
        } elseif ($exception instanceof \Illuminate\Database\QueryException) {
            return response()->json([
                'error' => 'Query run failed',
                'title' => 'Error',
                'message' => 'Please check again query!'
            ], 400);
        } elseif ($exception instanceof \Illuminate\Http\Exceptions\PostTooLargeException) {
            return response()->json([
                'error' => 'Request size too large',
                'title' => 'Error',
                'message' => 'Size of request to large to handle'
            ], 413);
        } elseif ($exception instanceof \App\Exceptions\SystemErrorException) {
            return response()->json([
                'title' => $exception->getTitle(),
                'message' => $exception->getMessage()
            ], $exception->getCode());
        } elseif ($exception instanceof \App\Exceptions\VoucherNotAvailableException) {
            return response()->json([
                'title' => $exception->getTitle(),
                'message' => $exception->getMessage()
            ], $exception->getCode());
        }

        return parent::render($request, $exception);
    }
}
