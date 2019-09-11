<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Session;
use Closure;

class Checksession
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
        if ( empty(Session::get('idUsuario') ) ){
            return redirect('/');
        }        
        return $next($request);
    }
}
