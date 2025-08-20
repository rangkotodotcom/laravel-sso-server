<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        $title = 'Login';
        return view('auth.login', compact('title'));
    }

    public function authentication(Request $request)
    {
        $credentials = $request->validate([
            'email'  => ['required', 'email'],
            'password'  => 'required|min:5|max:255',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('failed', 'Username / Password Salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json(['status' => true]);
    }

    public function register(Request $request)
    {
        //
    }

    public function forgotPassword(Request $request)
    {
        //
    }



    public function personal(Request $request)
    {
        $user = User::find('01986b2a-feb8-7286-9b50-2e6eb1f8b66d');
        $token = $user->createToken("Token {$user->email}", ['*']);

        dd($token);
    }
}
