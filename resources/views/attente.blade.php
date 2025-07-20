@extends('layouts.app')

@section('content')
    <div class="alert alert-warning text-center mt-5">
        Votre demande est en attente de validation par un administrateur.<br>
        @auth
            @if (Auth::user()->role === 'entrepreneur_approuve')
                <a href="{{ url('/entrepreneur/dashboard') }}" class="btn btn-primary">
                    Accéder à mon tableau de bord
                </a>
            @endif
        @endauth

    </div>
@endsection
