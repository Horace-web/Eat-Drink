<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Mail\NouvelleCommandeMail;
use Illuminate\Support\Facades\Mail;

class PanierController extends Controller
{
    // Affiche le panier
    public function index()
    {
        $panier = session()->get('panier', []);
        return view('panier.index', compact('panier'));
    }

    // Ajoute un produit au panier
    public function ajouter(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $panier = session()->get('panier', []);
        if (isset($panier[$id])) {
            $panier[$id]['quantite'] += 1;
        } else {
            $panier[$id] = [
                'id' => $product->id,
                'nom' => $product->nom,
                'prix' => $product->prix,
                'image_url' => $product->image_url,
                'quantite' => 1,
            ];
        }
        session(['panier' => $panier]);
        return redirect()->back()->with('success', 'Produit ajouté au panier !');
    }

    // Supprime un produit du panier
    public function supprimer($id)
    {
        $panier = session()->get('panier', []);
        if (isset($panier[$id])) {
            unset($panier[$id]);
            session(['panier' => $panier]);
        }
        return redirect()->route('panier.index')->with('success', 'Produit retiré du panier.');
    }

    // Vide le panier
    public function vider()
    {
        session()->forget('panier');
        return redirect()->route('panier.index')->with('success', 'Panier vidé.');
    }

    // Valide la commande
    public function validerCommande()
    {
        $panier = session()->get('panier', []);
        if (empty($panier)) {
            return redirect()->route('panier.index')->with('error', 'Votre panier est vide.');
        }
        // On suppose que tous les produits du panier viennent du même stand (sinon, on prend le premier)
        $stand_id = null;
        foreach ($panier as $item) {
            $product = \App\Models\Product::find($item['id']);
            if ($product) {
                $stand_id = $product->stand_id;
                break;
            }
        }
        if (!$stand_id) {
            return redirect()->route('panier.index')->with('error', 'Impossible de trouver le stand.');
        }
        $commande = Order::create([
            'stand_id' => $stand_id,
            'details_commande' => json_encode($panier),
        ]);
        // Envoi du mail à l'entrepreneur
        $stand = \App\Models\Stand::with('user')->find($stand_id);
        if ($stand && $stand->user && $stand->user->email) {
            Mail::to($stand->user->email)->send(new NouvelleCommandeMail($commande, $stand));
        }
        session()->forget('panier');
        return view('panier.confirmation');
    }
}
