@extends('layouts.app')

@section('title', 'Mes Produits')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Mes produits</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Ajouter un produit</a>

    @if($products->isEmpty())
        <p>Vous n'avez aucun produit pour le moment.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prix (€)</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->nom }}</td>
                    <td>{{ number_format($product->prix, 2, ',', ' ') }}</td>
                    <td>{{ $product->description ?? '-' }}</td>
                    <td>
                        @if($product->image_url)
                            <img src="{{ $product->image_url }}" alt="Image produit" style="max-height: 50px;">
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit ?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
