<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 use App\Models\Stand;
 use App\Models\Product;


class ExposantController extends Controller
{
    //


public function index()
{
    $query = request('q');
    $stands = Stand::with('user')
        ->whereHas('user', function ($q) {
            $q->where('role', 'entrepreneur_approuve');
        })
        ->when($query, function ($q) use ($query) {
            $q->where(function ($sub) use ($query) {
                $sub->where('nom_stand', 'like', "%$query%")
                    ->orWhereHas('products', function ($p) use ($query) {
                        $p->where('nom', 'like', "%$query%")
                            ->orWhere('description', 'like', "%$query%") ;
                    });
            });
        })
        ->get();
    return view('exposants.index', compact('stands'));
}



public function show($id)
{
    $stand = Stand::with(['user', 'products'])->findOrFail($id);
    return view('exposants.show', compact('stand'));
}


}
