<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('teacher.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('instructor')->attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('teacher.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function dashboard()
    {
        return view('teacher.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('instructor')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('teacher.login');
    }
}
