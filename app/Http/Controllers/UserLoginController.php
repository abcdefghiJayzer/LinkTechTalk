<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserLoginController extends Controller
{
    public function login()
    {
        return view('pages.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('username_email', 'password');

        $user = User::where('email', $credentials['username_email'])
            ->orWhere('username', $credentials['username_email'])
            ->first();

        if (
            $user && Auth::attempt(['email' => $user->email, 'password' => $credentials['password']]) ||
            Auth::attempt(['username' => $user->username, 'password' => $credentials['password']])
        ) {

            $request->session()->regenerate();
            return redirect()->intended(route('user.index'))->with('success', 'Welcome back!');
        }

        return redirect()->route('user.login')->with('error', 'Invalid credentials!');
    }


    public function register()
    {
        return view('pages.signup');
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('user.index')->with('success', 'Registration successful. Welcome!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.index');
    }
}
