@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Détails de l'Œuvre</h1>

        <div class="card">
            <div class="card-body">
                <h2 class="card-title">{{ $oeuvre->nom }}</h2>
                <p><strong>Descriptif:</strong> {{ $oeuvre->descriptif }}</p>
                <p><strong>Année de création:</strong> {{ $oeuvre->annee_creation }}</p>
                <p><strong>Catégorie:</strong> {{ $oeuvre->categorie }}</p>
                <p><strong>Style:</strong> {{ $oeuvre->epoque }}</p>
                <p><strong>Valeur:</strong> {{ number_format($oeuvre->valeur, 2, ',', ' ') }} €</p>

                @if($oeuvre->photo)
                    <div class="mt-4">
                        <strong>Photo:</strong><br>
                        <img src="{{ route('private.image', ['filename' => basename($oeuvre->photo)]) }}" alt="{{ $oeuvre->nom }}" class="img-fluid rounded">
                    </div>
                @endif
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('oeuvres.index') }}" class="btn btn-secondary">Retour à la liste des œuvres</a>
        </div>
    </div>
@endsection
