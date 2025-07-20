@extends('layouts.app')

@section('title', 'Mon panier')

@section('content')
<div class="container py-5">
    <h1>Mon panier</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(empty($panier))
        <p>Votre panier est vide.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($panier as $item)
                    @php $total += $item['prix'] * $item['quantite']; @endphp
                    <tr>
                        <td>{{ $item['nom'] }}</td>
                        <td>{{ number_format($item['prix'], 2) }} €</td>
                        <td>{{ $item['quantite'] }}</td>
                        <td>{{ number_format($item['prix'] * $item['quantite'], 2) }} €</td>
                        <td>
                            <form action="{{ route('panier.supprimer', $item['id']) }}" method="POST" style="display:inline;">
                                @csrf
                                <button class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total</th>
                    <th>{{ number_format($total, 2) }} €</th>
                    <th>
                        <form action="{{ route('panier.vider') }}" method="POST">
                            @csrf
                            <button class="btn btn-warning btn-sm">Vider le panier</button>
                        </form>
                    </th>
                </tr>
            </tfoot>
        </table>
        <form action="{{ route('panier.valider') }}" method="POST" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-primary">Valider la commande</button>
        </form>
    @endif
</div>
@endsection 