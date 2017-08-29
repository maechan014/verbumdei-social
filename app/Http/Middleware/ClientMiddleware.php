<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class ClientMiddleware
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
        if (Session::get('usertype') != 'CLIENT')
        {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
