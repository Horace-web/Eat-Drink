@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10">
            <h2 class="mb-4 text-center">Demandes d'entrepreneurs en attente</h2>

            @if(session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif

            <div class="table-wrapper">
                <table class="table table-striped align-middle w-100">
                    <thead class="table-light">
                        <tr>
                            <th class="text-nowrap">Nom</th>
                            <th class="text-nowrap">Email</th>
                            <th class="text-nowrap">Entreprise</th>
                            <th class="text-nowrap">Inscription</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($demandes as $user)
                            <tr>
                                <td class="text-break">{{ $user->name }}</td>
                                <td class="text-break">{{ $user->email }}</td>
                                <td class="text-break">{{ $user->nom_entreprise }}</td>
                                <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <div class="d-flex flex-column gap-2">
                                        <!-- Approuver -->
                                        <form action="{{ url('/admin/approve/'.$user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm w-100">✅ Approuver</button>
                                        </form>

                                        <!-- Rejeter avec motif -->
                                        <form action="{{ url('/admin/reject/'.$user->id) }}" method="POST">
                                            @csrf
                                            <input type="text" name="motif_rejet" placeholder="Motif (optionnel)" class="form-control form-control-sm mb-1">
                                            <button type="submit" class="btn btn-danger btn-sm w-100">❌ Rejeter</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Aucune demande en attente.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
