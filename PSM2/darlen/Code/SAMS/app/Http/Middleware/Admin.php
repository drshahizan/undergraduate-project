<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check() && Auth::user()->userType === 1){
            return $next($request);
        } else {
            return redirect('/'); // redirect to login or wherever you want
        }
    }
}
