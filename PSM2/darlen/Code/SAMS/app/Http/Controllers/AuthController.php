<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    const ADMIN = 1;
    const TEACHER = 2;
    const STUDENT = 3;

    public function store(LoginRequest $request) {
        $request->authenticate();
        $request->session()->regenerate();

        switch (auth()->user()->userType) {
            case self::ADMIN:
                return redirect('/beranda-admin');
            case self::TEACHER:
                return redirect('/beranda-guru');
            case self::STUDENT:
                return redirect('/beranda-siswa');
            default:
                return redirect('/');
        }
    }
    
    public function destroy(Request $request)
    {
        $userType = auth()->user()->userType;
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        
        switch ($userType) {
            case self::ADMIN:
                return redirect('/');
            case self::TEACHER:
                return redirect('/');
            case self::STUDENT:
                return redirect('/');
            default:
                return redirect('/');
        }
    }
}
