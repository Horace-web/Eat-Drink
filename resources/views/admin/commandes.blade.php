@extends('layouts.app')

@section('title', 'Commandes')

@section('content')
<div class="container py-5">
    <h1>Liste des commandes</h1>
    @if($commandes->isEmpty())
        <p>Aucune commande pour le moment.</p>
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
                                    <li>
                                        {{ $item['nom'] }} x {{ $item['quantite'] }} ({{ number_format($item['prix'], 2) }} €)
                                    </li>
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