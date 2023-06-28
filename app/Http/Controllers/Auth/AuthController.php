<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\User_Auth_Trait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;



class AuthController extends Controller
{
    use User_Auth_Trait;

    /**
     * @return View
     */
    public function login () : View
    {
        return view('auth.login');
    }

    /**
     * @return View
     */
    public function register() : View {
        return view('auth.register');
    }

    public function logout() : RedirectResponse
    {
        Auth::logout();

        return redirect('/');
    }

}
