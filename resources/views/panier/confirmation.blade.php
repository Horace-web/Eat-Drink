@extends('layouts.app')

@section('title', 'Commande validée')

@section('content')
<div class="container py-5 text-center">
    <h1>Merci pour votre commande !</h1>
    <p>Votre commande a bien été enregistrée. Un exposant vous contactera si besoin.</p>
    <a href="{{ url('/') }}" class="btn btn-success mt-4">Retour à l'accueil</a>
</div>
@endsection 