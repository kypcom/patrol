<?php

namespace App\Http\Middleware;
use Illuminate\Contracts\Auth\Guard;
use Closure;
use Session;

use Auth;
use Laracasts\Flash\Flash;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    protected $auth;

    public function __contruct(Guard $auth)
    {
        $this->auth=$auth;
    }
   public function handle($request, Closure $next)
    {
         if(Auth::user()->id_rol !== 1 && Auth::user()->id_rol !== 2)
        {
             Flash::error("No tienes acceso");

             return redirect()->route('log.index');   
                       
        }
        return $next($request);
    }
}
