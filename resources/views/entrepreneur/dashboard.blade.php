@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Tableau de bord</h1>

    <div class="alert alert-info mb-4">
        <strong>Votre email professionnel :</strong> {{ auth()->user()->email }}
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary h-100">
                <div class="card-body">
                    <h5 class="card-title">Nombre de stands</h5>
                    <p class="card-text fs-2">{{ $standsCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success h-100">
                <div class="card-body">
                    <h5 class="card-title">Nombre de produits</h5>
                    <p class="card-text fs-2">{{ $productCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-info h-100">
                <div class="card-body">
                    <h5 class="card-title">Chiffre d’affaires total</h5>
                    <p class="card-text fs-2">{{ number_format($totalRevenue, 2, ',', ' ') }} €</p>
                </div>
            </div>
        </div>
    </div>

    <h2 class="mt-5 mb-3">Commandes reçues</h2>
    @if($commandes->isEmpty())
        <p>Aucune commande reçue pour vos stands.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Stand</th>
                    <th>Date</th>
                    <th>Détails</th>
                </tr>
            </thead>
            <tbody>
                @foreach($commandes as $commande)
                    <tr>
                        <td>{{ $commande->id }}</td>
                        <td>{{ $commande->stand->nom_stand ?? '-' }}</td>
                        <td>{{ $commande->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <ul>
                                @foreach(is_array($commande->details_commande) ? $commande->details_commande : json_decode($commande->details_commande, true) as $item)
                                    <li>{{ $item['nom'] }} x {{ $item['quantite'] }} ({{ number_format($item['prix'], 2) }} €)</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
