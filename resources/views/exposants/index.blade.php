@extends('layouts.app')

@section('title', 'Nos Exposants')

@section('content')
    <div class="text-center mb-5">
        <h2 class="mb-3">Nos Exposants</h2>
        <p>Découvrez les talents culinaires présents à Eat&Drink !</p>
    </div>

    <form method="GET" action="" class="mb-4">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Rechercher un stand ou un produit..." value="{{ request('q') }}">
            <button class="btn btn-outline-primary" type="submit">Rechercher</button>
        </div>
    </form>

    <div class="row">
        @forelse($stands as $stand)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $stand->nom_stand }}</h5>
                        <p class="card-text">{{ Str::limit($stand->description, 100) }}</p>
                        <p class="text-muted mt-auto">👨‍🍳 {{ $stand->user->nom_entreprise }}</p>
                        <a href="{{ route('exposants.show', $stand->id) }}" class="btn btn-primary mt-3">Voir les produits</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">Aucun stand disponible pour le moment.</p>
        @endforelse
    </div>
@endsection
