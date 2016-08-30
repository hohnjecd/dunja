<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        if(Auth::check()){    //validacija ako je logovani korisnik admin

            if(Auth::user()->isAdmin()){

                return $next($request);   //ako je sve ok da se nastavi dalje

            }



        }

        return redirect('/');


    }
}
