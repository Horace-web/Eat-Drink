<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class EntrepreneurController extends Controller
{

   public function dashboard()
{
    $user = \Illuminate\Support\Facades\Auth::user();
    $standsIds = $user->stands()->pluck('id');
    $standsCount = $standsIds->count();
    $productCount = \App\Models\Product::whereIn('stand_id', $standsIds)->count();
    $totalRevenue = 0;
    $commandes = Order::whereIn('stand_id', $standsIds)->latest()->get();
    return view('entrepreneur.dashboard', compact('standsCount', 'productCount', 'totalRevenue', 'commandes'));
}

}
