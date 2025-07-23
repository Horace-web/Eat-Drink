<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Stand;

class ProductController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Récupérer tous les produits liés aux stands de l'entrepreneur
        $standIds = $user->stands->pluck('id');
        $products = Product::whereIn('stand_id', $standIds)->get();

        return view('entrepreneur.products.index', compact('products'));
    }

    public function create()
    {
        $user = Auth::user();

        // On passe les stands de l'utilisateur à la vue pour choisir à quel stand appartient le produit
        $stands = $user->stands;

        if ($stands->isEmpty()) {
            return redirect()->back()->with('error', 'Vous n\'avez pas de stand.');
        }

        return view('entrepreneur.products.create', compact('stands'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'stand_id' => 'required|exists:stands,id',
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url',
        ]);

        // Vérifie que le stand appartient à l'utilisateur
        if (!$user->stands->contains('id', $request->stand_id)) {
            abort(403, 'Vous n\'êtes pas autorisé à utiliser ce stand.');
        }

        Product::create([
            'stand_id' => $request->input('stand_id'),
            'nom' => $request->input('nom'),
            'prix' => $request->input('prix'),
            'description' => $request->input('description'),
            'image_url' => $request->input('image_url'),
        ]);

        return redirect()->route('products.index')->with('success', 'Produit ajouté avec succès.');
    }

    public function edit(Product $product)
{
    $user = Auth::user();

    // Vérifie que le produit appartient à un stand de l'utilisateur
    if (!$user->stands->contains('id', $product->stand_id)) {
        abort(403);
    }

    // Récupère les stands de l'utilisateur pour le select
    $stands = $user->stands;

    return view('entrepreneur.products.edit', compact('product', 'stands'));
}


    public function update(Request $request, Product $product)
    {
        $user = Auth::user();

        if (!$user->stands->contains('id', $product->stand_id)) {
            abort(403);
        }

        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url',
        ]);

        $product->update($request->only('nom', 'prix', 'description', 'image_url'));

        return redirect()->route('products.index')->with('success', 'Produit mis à jour avec succès.');
    }

    public function destroy(Product $product)
    {
        $user = Auth::user();

        if (!$user->stands->contains('id', $product->stand_id)) {
            abort(403);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produit supprimé avec succès.');
    }
}
