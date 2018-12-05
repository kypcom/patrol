<?php

namespace App\Http\Middleware;
use Illuminate\Contracts\Auth\Guard;
use Closure;
use Auth;
use Laracasts\Flash\Flash;

class SuperAdmin
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
         if(Auth::user()->id_rol !== 1)
        {

             Flash::error("No tienes acceso");

            return redirect()->route('users.index');


            
        }


        return $next($request);
    }
}
