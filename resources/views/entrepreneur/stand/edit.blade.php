@extends('layouts.app')

@section('title', 'Modifier le stand')

@section('content')
<div class="container py-5">
    <h1>Modifier le stand</h1>

    <form action="{{ route('entrepreneur.stands.update', $stand) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom_stand" class="form-label">Nom du stand</label>
            <input type="text" name="nom_stand" id="nom_stand" class="form-control" required value="{{ old('nom_stand', $stand->nom_stand) }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $stand->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Mettre à jour</button>
        <a href="{{ route('entrepreneur.stands.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
