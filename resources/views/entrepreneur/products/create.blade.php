@extends('layouts.app')

@section('title', 'Ajouter un produit')

@section('content')
<div class="container py-5">
    <h1>Ajouter un produit</h1>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nom" class="form-label">Nom du produit</label>
            <input type="text" name="nom" id="nom" class="form-control" required value="{{ old('nom') }}">
        </div>

        <div class="mb-3">
            <label for="prix" class="form-label">Prix (€)</label>
            <input type="number" name="prix" id="prix" class="form-control" min="0" step="0.01" required value="{{ old('prix') }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description (optionnel)</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image_url" class="form-label">URL de l'image (optionnel)</label>
            <input type="url" name="image_url" id="image_url" class="form-control" value="{{ old('image_url') }}">
        </div>

        <select name="stand_id" class="form-control mb-3" required>
            @foreach($stands as $stand)
                <option value="{{ $stand->id }}">{{ $stand->nom }}</option>
            @endforeach
        </select>


        <button type="submit" class="btn btn-primary">Ajouter</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
