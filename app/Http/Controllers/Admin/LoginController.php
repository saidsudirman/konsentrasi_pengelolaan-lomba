<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        $type_menu = 'event';
        return view('auth.index', compact('type_menu'));
    }

    public function login(Request $request)
    {
      $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // dd($credentials);

        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
        return redirect()->intended('dashboard')->withSuccess('Signed in');
        }

        return back()->with('error', 'Username atau Password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
