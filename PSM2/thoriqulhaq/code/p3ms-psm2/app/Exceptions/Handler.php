<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Inertia\Inertia;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    
    public function render($request, Throwable $e)
    {
        $response = parent::render($request, $e);

        // if (in_array($response->status(), [500, 503, 404, 403])) {
        //     return Inertia::render('Error', ['status' => $response->status()])
        //         ->toResponse($request)
        //         ->setStatusCode($response->status());
        // } elseif ($response->status() === 419) {
        //     return back()->with([
        //         'message' => 'The page expired, please try again.',
        //     ]);
        // }

        return $response;
    }
}
