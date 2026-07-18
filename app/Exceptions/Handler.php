<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\Exceptions\PlatIndisponibleException;

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

    protected function unauthenticated($request, \Illuminate\Auth\AuthenticationException $exception)
    {
        if ($request->expectsJson() || $request->ajax()) {
            $session_invite = session()->get('invite_session');
            return response()->json(['error' => 'connect', 'message' => 'Vous devez vous connecter', 'session' => $session_invite], 403);
        }

        return redirect()->guest(route('login'));
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof PlatIndisponibleException) {

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage(),
                    'raison' => $e->raison,
                ], 422);
            }

            return back()->withErrors([
                'plat' => $e->getMessage(),
            ]);
        }

        return parent::render($request, $e);
    }
}
