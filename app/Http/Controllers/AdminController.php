<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // 🟦 Affiche le dashboard avec les entrepreneurs en attente
    public function dashboard()
    {
        $utilisateursEnAttente = User::where('role', 'entrepreneur_en_attente')
                                      ->where('statut', 'en_attente')
                                      ->get();

        return view('admin.dashboard', compact('utilisateursEnAttente'));
    }

    // 🟩 Valide un utilisateur (approuve)
    public function valider($id)
    {
        $user = User::findOrFail($id);
        $user->role = 'entrepreneur_approuve';
        $user->statut = 'approuve';
        $user->save();

        return redirect()->back()->with('success', "L'utilisateur a été approuvé.");
    }

    // 🟥 Rejette un utilisateur
    public function rejeter($id)
    {
        $user = User::findOrFail($id);
        $user->statut = 'rejete';
        $user->save();

        return redirect()->back()->with('success', "L'utilisateur a été rejeté.");
    }
}

