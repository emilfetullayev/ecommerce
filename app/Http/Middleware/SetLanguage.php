<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLanguage
{
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has('locale') && in_array(session()->get('locale'), ['az', 'en', 'ru', 'zh'])) {
            app()->setLocale(session()->get('locale'));
        } else {
            app()->setLocale('az');
            session()->put('locale', 'az');
        }

        return $next($request);
    }
}
