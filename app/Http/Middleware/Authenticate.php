<?php

namespace App\Http\Middleware;

use App\Exceptions\ResponseHandler;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  Request  $request
     * @return void
     */
    protected function redirectTo($request): void
    {
      //
    }
}
