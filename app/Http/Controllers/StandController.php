<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class StandController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        // Affiche les stands de l'utilisateur connecté
        $stands = Auth::user()->stands()->get();

        return view('entrepreneur.stand.index', compact('stands'));
    }

    public function create()
    {
        return view('entrepreneur.stand.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_stand' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Auth::user()->stands()->create($request->only('nom_stand', 'description'));

        return redirect()->route('entrepreneur.stands.index')->with('success', 'Stand ajouté avec succès.');
    }

    public function edit(Stand $stand)
    {
        // $this->authorize('update', $stand); // Optionnel : vérifie que l'utilisateur peut modifier

        return view('entrepreneur.stand.edit', compact('stand'));
    }

    public function update(Request $request, Stand $stand)
    {
        // $this->authorize('update', $stand);

        $request->validate([
            'nom_stand' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $stand->update($request->only('nom_stand', 'description'));

        return redirect()->route('entrepreneur.stands.index')->with('success', 'Stand mis à jour avec succès.');
    }

    public function destroy(Stand $stand)
    {
        // $this->authorize('delete', $stand);

        $stand->delete();

        return redirect()->route('entrepreneur.stands.index')->with('success', 'Stand supprimé.');
    }
}
