@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Demandes d'entrepreneurs en attente</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Nom entreprise</th>
                <th>Date d'inscription</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($demandes as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->nom_entreprise }}</td>
                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                    <td style="display:flex; gap:5px;">
                        <form action="{{ url('/admin/approve/'.$user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Approuver</button>
                        </form>
                        <form action="{{ url('/admin/reject/'.$user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="text" name="motif_rejet" placeholder="Motif (optionnel)" class="form-control form-control-sm" style="width:120px;display:inline-block;">
                            <button type="submit" class="btn btn-danger btn-sm">Rejeter</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">Aucune demande en attente.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
