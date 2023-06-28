<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function store(LoginRequest $request) {
        $request->authenticate();
        $request->session()->regenerate();
        
        if (auth()->user()->user_type != 'Admin') {
            return redirect(RouteServiceProvider::HOME);
        } else {
            return redirect(RouteServiceProvider::ADMIN);
        }
    }
    
    public function destroy(Request $request)
    {
        if (auth()->user()->user_type != 'Admin') {
            $route = 'login.staff.get';
        } else {
            $route = 'login.admin.get';
        }
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route($route);
    }
}
