@extends('layouts.app')

@section('title', 'Modifier un produit')

@section('content')
<div class="container py-5">
    <h1>Modifier un produit</h1>

    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom" class="form-label">Nom du produit</label>
            <input type="text" name="nom" id="nom" class="form-control" required
                value="{{ old('nom', $product->nom) }}">
        </div>

        <div class="mb-3">
            <label for="prix" class="form-label">Prix (€)</label>
            <input type="number" name="prix" id="prix" class="form-control" min="0" step="0.01" required
                value="{{ old('prix', $product->prix) }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description (optionnel)</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image_url" class="form-label">URL de l'image (optionnel)</label>
            <input type="url" name="image_url" id="image_url" class="form-control"
                value="{{ old('image_url', $product->image_url) }}">
        </div>

        <div class="mb-3">
            <label for="stand_id" class="form-label">Stand associé</label>
            <select name="stand_id" class="form-control" required>
                @foreach($stands as $stand)
                    <option value="{{ $stand->id }}"
                        {{ old('stand_id', $product->stand_id) == $stand->id ? 'selected' : '' }}>
                        {{ $stand->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
