<?php

namespace App\Exceptions;

use App\Response\ResponseHandler;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * @throws Throwable
     */
    public function render($request, Exception|Throwable $e): Response|JsonResponse|\Symfony\Component\HttpFoundation\Response
    {
        $this->renderable(function (NotFoundHttpException $e) {
            return ResponseHandler::notFound();
        })->renderable(function (AuthenticationException $e) {
            return ResponseHandler::notAuthorized();
        })->renderable(function (UnauthorizedException $e) {
            return ResponseHandler::notHaveRole();
        })->renderable(function (RoleAlreadyExists $e) {
            return ResponseHandler::roleAlreadyExists();
        });

        return parent::render($request, $e);
    }
}
