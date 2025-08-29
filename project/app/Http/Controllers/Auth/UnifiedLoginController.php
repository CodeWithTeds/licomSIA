<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UnifiedLoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $remember = $request->has('remember');

        // First try instructor guard
        if (Auth::guard('instructor')->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('teacher.dashboard'));
        }

        // Then try web guard for students and admins
        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();
            $request->session()->regenerate();
            
            // Redirect based on user role
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } elseif ($user->role === 'student') {
                return redirect()->intended(route('student.dashboard'));
            }
            
            // If role is neither admin nor student, logout
            Auth::logout();
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}