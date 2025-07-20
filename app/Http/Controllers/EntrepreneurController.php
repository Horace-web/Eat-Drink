<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntrepreneurController extends Controller
{

   public function dashboard()
{
    $user = \Illuminate\Support\Facades\Auth::user();

    $standsCount = $user->stands()->count();

    // Compte total des produits liés aux stands de l'utilisateur
    $productCount = \App\Models\Product::whereIn('stand_id', $user->stands()->pluck('id'))->count();


    $totalRevenue = 0; 

    return view('entrepreneur.dashboard', compact('standsCount', 'productCount', 'totalRevenue'));
}

}
