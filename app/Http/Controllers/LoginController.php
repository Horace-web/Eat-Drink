<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            } elseif ($user->role === 'entrepreneur_approuve') {
                return redirect('/entrepreneur/dashboard');
            } elseif ($user->role === 'entrepreneur_en_attente') {
                return redirect()->route('attente');
            } else {
                return redirect('/');
            }
        }

        return back()->withErrors([
            'email' => 'Identifiants invalides.',
        ])->withInput();
    }
     public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/'); // Redirection vers la page d’accueil ou autre
    }
}
