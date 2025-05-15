<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
       
        if (Auth::check()) {
            return redirect()->route('profil'); 
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                
                if ($request->expectsJson() || $request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'success' => true, 
                        'redirect' => '/dashboard'
                    ]);
                }
                
                return redirect()->intended('/dashboard'); 
            }

            if ($request->expectsJson() || $request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => [
                        'email' => ['The provided credentials do not match our records.']
                    ]
                ], 422);
            }

            return back()->withErrors([
                'email' => 'Invalid credentials. Please check your email and password.',
            ])->onlyInput('email');
        } catch (ValidationException $e) {
            if ($request->expectsJson() || $request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $e->errors(),
                ], 422);
            }
            
            throw $e;
        }
    }   
    
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

