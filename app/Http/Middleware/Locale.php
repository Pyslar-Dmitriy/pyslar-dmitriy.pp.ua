<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;


class Locale
{
    public function handle($request, Closure $next)
    {
        if (session('applocale')) {
            App::setLocale(session('applocale'));
        }
        else { // This is optional as Laravel will automatically set the fallback language if there is none specified
            App::setLocale(Config::get('app.locale'));
        }
        return $next($request);
    }
}
