<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->user()?->preferred_locale
            ?? session('locale', config('app.locale'));

        if (array_key_exists($locale, config('app.supported_locales'))) {
            App::setLocale($locale);
            session(['locale' => $locale]);
        }

        return $next($request);
    }
}
