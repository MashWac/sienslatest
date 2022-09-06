<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MustbeLogged
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('logged')){
            return redirect('login')->with('status','You Are Not Logged in. Please Login');
        }
        return $next($request);
    }
}
