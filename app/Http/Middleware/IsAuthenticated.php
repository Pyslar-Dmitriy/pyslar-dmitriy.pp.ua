<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){  //если юзер не зашел, пинаем его на главную
            if(Auth::user()->id == 5){ //если юзер с пятым айдишником, вместо страницы профиля кидаем его в админку
                return redirect('secret');
            }
            return $next($request);
        }
        return redirect('/');
    }
}
