@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
    {{-- HERO avec image de fond --}}
    <div class="p-5 text-white text-center rounded" style="background-image: url('https://images.unsplash.com/photo-1529692236671-f1f3c1a1d3ee?auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center;">
        <div class="bg-dark bg-opacity-50 p-5 rounded">
            <h1 class="display-4">Bienvenue à Eat&Drink 🍽️</h1>
            <p class="lead">Le plus grand rassemblement culinaire pour les gourmets et les créateurs de saveurs !</p>
            <a href="" class="btn btn-primary btn-lg mt-3">Demander un stand</a>
        </div>
    </div>

    {{-- À propos de l’événement --}}
    <div class="container my-5">
        <h2 class="text-center mb-4">À propos de l'événement</h2>
        <div class="row">
            <div class="col-md-6">
                <p class="text-justify">
                    Eat&Drink est un événement annuel qui rassemble des passionnés de gastronomie, des restaurateurs,
                    des artisans et des visiteurs venus découvrir de nouvelles saveurs. Pendant plusieurs jours,
                    les exposants proposent leurs produits au public dans une ambiance festive et conviviale.
                </p>
            </div>
            <div class="col-md-6">
                <img src="https://toevents.ch/wp-content/uploads/2019/05/Stands.jpeg" class="img-fluid rounded" alt="Stand gastronomique">
            </div>
        </div>
    </div>

    {{-- Pourquoi participer ? --}}
    <div class="bg-light py-5">
        <div class="container">
            <h3 class="text-center mb-4">Pourquoi devenir exposant ?</h3>
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="p-4 shadow rounded bg-white">
                        <h5>🌟 Visibilité</h5>
                        <p>Présentez vos produits à des milliers de visiteurs passionnés.</p>
                    </div>
                </div>
                <div class="col-md-4 mt-4 mt-md-0">
                    <div class="p-4 shadow rounded bg-white">
                        <h5>🤝 Réseautage</h5>
                        <p>Rencontrez d'autres professionnels du secteur culinaire.</p>
                    </div>
                </div>
                <div class="col-md-4 mt-4 mt-md-0">
                    <div class="p-4 shadow rounded bg-white">
                        <h5>💡 Innovation</h5>
                        <p>Testez vos nouveaux produits et obtenez des retours en direct.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Appel à action final --}}
    <div class="text-center py-5 bg-primary text-white">
        <h4 class="mb-3">Prêt à rejoindre l’aventure ?</h4>
        <a href="" class="btn btn-light btn-lg">Demander un stand maintenant</a>
    </div>
@endsection
