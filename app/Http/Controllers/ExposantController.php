<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 use App\Models\Stand;
 use App\Models\Produit;

 
class ExposantController extends Controller
{
    //
   

public function index()
{
    $stands = Stand::with('user')
        ->whereHas('user', function ($query) {
            $query->where('role', 'entrepreneur_approuve');
        })
        ->get();

    return view('exposants.index', compact('stands'));
}



public function show($id)
{
    $stand = Stand::with(['user', 'produits'])->findOrFail($id);
    return view('exposants.show', compact('stand'));
}


}
