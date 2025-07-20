@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4 fw-bold">Utilisateurs en attente de validation</h1>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if($utilisateursEnAttente->isEmpty())
        <div class="text-center text-muted">
            Aucun utilisateur en attente pour le moment.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Nom Entreprise</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($utilisateursEnAttente as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->nom_entreprise ?? '-' }}</td>
                            <td>
                                <form action="{{ route('admin.valider', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">
                                        ✅ Valider
                                    </button>
                                </form>
                                <form action="{{ route('admin.rejeter', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        ❌ Rejeter
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
