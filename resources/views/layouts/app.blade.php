<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Eat&Drink')</title>

    {{-- CSS Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Style personnalisé pour fixer le footer --}}
    <style>
        html, body {
            height: 100%;
            overflow-x:hidden;
        }
        body {
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1;
        }
    </style>
</head>
<body>

    {{-- HEADER GLOBAL (Navbar responsive Bootstrap) --}}
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">🍽️ Eat&Drink</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="mainNavbar">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="{{ url('/') }}" class="nav-link">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/exposants') }}" class="nav-link">Nos exposants</a>
                        </li>

                        @guest
                            {{-- Utilisateur non connecté --}}
                            <li class="nav-item">
                                <a href="{{ url('/auth') }}" class="nav-link">Connexion</a>
                            </li>
                        @else
                            {{-- Utilisateur connecté --}}

                            {{-- Lien Mes produits pour entrepreneurs validés --}}
                            @if(auth()->user()->role === 'entrepreneur_approuve')
                                <li class="nav-item">
                                    <a href="{{ route('products.index') }}" class="nav-link">Mes produits</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('entrepreneur.stands.index') }}" class="nav-link">Mes stands</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('entrepreneur.dashboard') }}" class="nav-link">Tableau de bord</a>
                                </li>
                            @endif


                            {{-- Bouton Déconnexion --}}
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-light btn-sm ms-lg-2 mt-2 mt-lg-0">
                                        Déconnexion
                                    </button>
                                </form>
                            </li>
                        @endguest

                        {{-- <li class="nav-item">
                            <a href="" class="btn btn-outline-light btn-sm ms-lg-2 mt-2 mt-lg-0">Demander un stand</a>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    {{-- CONTENU PRINCIPAL --}}
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    {{-- FOOTER GLOBAL COLLÉ EN BAS --}}
    <footer class="bg-light text-center py-3">
        <small>&copy; 2025 Eat&Drink. Tous droits réservés.</small>
    </footer>

    {{-- JS Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
