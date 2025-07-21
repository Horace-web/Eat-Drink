@extends('layouts.app')

@section('title', 'Connexion / Inscription')

@section('content')
<div class="container d-flex align-items-center" style="min-height: 80vh;">
    <div class="row justify-content-center w-100">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow">
                <div class="card-header p-0">
                    <div class="d-flex">
                        <button class="btn btn-primary w-50 rounded-0 btn-switch active" id="inscription-link">Inscription</button>
                        <button class="btn btn-primary w-50 rounded-0 btn-switch" id="connexion-link">Connexion</button>
                    </div>
                </div>
                <div class="card-body">
                    {{-- Affichage des erreurs --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif
                    {{-- Formulaire d'inscription --}}
                    <form id="inscription-form" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                            <span class="error-message" id="nom-error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" required>
                            <span class="error-message" id="prenom-error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="nom_entreprise" class="form-label">Nom de l'entreprise</label>
                            <input type="text" class="form-control" id="nom_entreprise" name="nom_entreprise" required>
                            <span class="error-message" id="nom_entreprise-error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <span class="error-message" id="email-error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                            <span class="error-message" id="password-error"></span>
                        </div>
                        <div class="card-footer text-center bg-white border-0">
                            <button type="submit" class="btn btn-primary">S'inscrire</button>
                        </div>
                    </form>

                    {{-- Formulaire de connexion --}}
                    <form id="connexion-form" method="POST" action="{{ route('login') }}" class="d-none">
                        @csrf
                        <div class="mb-3">
                            <label for="email_connexion" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email_connexion" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_connexion" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="password_connexion" name="password" required>
                        </div>
                        <div class="text-end">
                            <a href="#" class="small text-primary">Mot de passe oublié ?</a>
                        </div>
                        <div class="card-footer text-center bg-white border-0">
                            <button type="submit" class="btn btn-primary">Se connecter</button>
                        </div>
                        <div id="login-error" class="text-danger mt-2"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- JS de gestion des formulaires --}}
<script>
    const inscriptionForm = document.getElementById('inscription-form');
    const connexionForm = document.getElementById('connexion-form');
    const inscriptionLink = document.getElementById('inscription-link');
    const connexionLink = document.getElementById('connexion-link');

    inscriptionLink.addEventListener('click', (e) => {
        e.preventDefault();
        inscriptionForm.classList.remove('d-none');
        connexionForm.classList.add('d-none');
        inscriptionLink.classList.add('active');
        connexionLink.classList.remove('active');
    });

    connexionLink.addEventListener('click', (e) => {
        e.preventDefault();
        connexionForm.classList.remove('d-none');
        inscriptionForm.classList.add('d-none');
        connexionLink.classList.add('active');
        inscriptionLink.classList.remove('active');
    });
</script>

{{-- Style personnalisé --}}
<style>
    .error-message {
        color: red;
        font-size: 0.8rem;
    }
    .btn-switch.active {
        background-color: #145dbf !important;
    }
</style>
@endsection
