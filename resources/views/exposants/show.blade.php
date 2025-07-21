@extends('layouts.app')

@section('title', $stand->nom)

@section('content')
    <div class="mb-4">
        <h2>{{ $stand->nom }}</h2>
        <p class="text-muted">Par {{ $stand->user->nom_entreprise }}</p>
        <p>{{ $stand->description }}</p>
    </div>

    <h4 class="mb-3">Produits disponibles :</h4>
    <div class="row">
        @foreach($stand->products as $produit)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($produit->image_url)
                        <img src="{{ $produit->image_url }}" class="card-img-top" alt="Produit">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $produit->nom }}</h5>
                        <p class="card-text">{{ Str::limit($produit->description, 80) }}</p>
                        <p class="text-primary fw-bold">{{ number_format($produit->prix, 2) }} €</p>
                        <form action="{{ route('panier.ajouter', $produit->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Ajouter au panier</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
