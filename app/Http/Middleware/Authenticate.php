<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * User login olmadan protected route-a girəndə redirect olur
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {

            if ($request->is('admin/*')) {
                return route('admin.login');
            }

            return url('/login');
        }
    }
}
