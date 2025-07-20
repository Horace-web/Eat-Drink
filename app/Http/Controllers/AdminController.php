<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Mail\StatutEntrepreneurMail;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    // Affiche le dashboard avec la liste des demandes en attente
    public function dashboard()
    {
        $demandes = User::where('role', 'entrepreneur_en_attente')
            ->orWhere('statut', 'en_attente')
            ->get();
        return view('admin.dashboard', compact('demandes'));
    }

    // Approuver une demande
    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->role = 'entrepreneur_approuve';
        $user->statut = 'approuve';
        $user->save();
        // Envoi du mail d'approbation
        Mail::to($user->email)->send(new StatutEntrepreneurMail($user, 'approuve'));
        return redirect()->back()->with('success', 'Demande approuvée avec succès.');
    }

    // Rejeter une demande (avec motif optionnel)
    public function reject(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->role = 'entrepreneur_en_attente'; // On garde le rôle, mais on change le statut
        $user->statut = 'rejete';
        // (Bonus) Enregistrer le motif si fourni
        if ($request->filled('motif_rejet')) {
            $user->motif_rejet = $request->input('motif_rejet');
        }
        $user->save();
        // Envoi du mail de rejet
        Mail::to($user->email)->send(new StatutEntrepreneurMail($user, 'rejete', $user->motif_rejet));
        return redirect()->back()->with('success', 'Demande rejetée.');
    }

    // Affiche la liste des commandes
    public function commandes()
    {
        $commandes = Order::with('stand')->latest()->get();
        return view('admin.commandes', compact('commandes'));
    }
}

