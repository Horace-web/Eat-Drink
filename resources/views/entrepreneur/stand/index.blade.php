@extends('layouts.app')

@section('title', 'Mes stands')

@section('content')
<div class="container py-5">
    <h1>Mes stands</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('entrepreneur.stands.create') }}" class="btn btn-primary mb-3">Ajouter un stand</a>

    @if($stands->isEmpty())
        <p>Aucun stand trouvé.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stands as $stand)
                    <tr>
                        <td>{{ $stand->nom_stand }}</td>
                        <td>{{ $stand->description }}</td>
                        <td>
                            <a href="{{ route('entrepreneur.stands.edit', $stand) }}" class="btn btn-sm btn-warning">Modifier</a>
                            <form action="{{ route('entrepreneur.stands.destroy', $stand) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirmer la suppression ?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
