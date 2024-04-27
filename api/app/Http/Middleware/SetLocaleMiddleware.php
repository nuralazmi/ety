<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $lang = $request->query('lang') ?: $request->header('Accept-Language');

        if ($lang && in_array($lang, config('app.supported_locales')))
            App::setLocale($lang);

        return $next($request);
    }
}
