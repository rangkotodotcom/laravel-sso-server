<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class MicrosoftController extends Controller
{
    public function redirectLogin(Request $request)
    {
        return Socialite::driver('azure')->redirect();
    }

    public function redirectRegister(Request $request)
    {
        return Socialite::driver('azure')->redirect();
    }
}
