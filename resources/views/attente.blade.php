@extends('layouts.app')

@section('title', 'Statut de votre demande')

@section('content')
<div class="container py-5 text-center">
    <h1>Statut de votre demande</h1>
    @if(auth()->check() && auth()->user()->statut === 'rejete')
        <div class="alert alert-danger">
            Votre demande a été rejetée.<br>
            @if(auth()->user()->motif_rejet)
                <strong>Motif :</strong> {{ auth()->user()->motif_rejet }}
            @endif
        </div>
    @else
        <div class="alert alert-info">
            Votre demande est en attente d'approbation par l'administration.<br>
            Vous recevrez un email dès qu'une décision sera prise.
        </div>
    @endif
</div>
@endsection
