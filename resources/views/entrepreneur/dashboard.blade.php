@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Tableau de bord</h1>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary h-100">
                <div class="card-body">
                    <h5 class="card-title">Nombre de stands</h5>
                    <p class="card-text fs-2">{{ $standsCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success h-100">
                <div class="card-body">
                    <h5 class="card-title">Nombre de produits</h5>
                    <p class="card-text fs-2">{{ $productCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-info h-100">
                <div class="card-body">
                    <h5 class="card-title">Chiffre d’affaires total</h5>
                    <p class="card-text fs-2">{{ number_format($totalRevenue, 2, ',', ' ') }} €</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
