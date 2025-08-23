<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectLogin(Request $request)
    {
        return Socialite::driver('google')->redirect();
    }

    public function redirectRegister(Request $request)
    {
        return Socialite::driver('google')->redirect();
    }
}
