<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FrontUser
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
        if(empty(session()->get('front_acct'))){
            return redirect('/');
        }

        return $next($request);
    }
}
