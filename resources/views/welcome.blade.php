@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-4">
        <h1 class="display-4">Bienvenue dans la Gestion des Œuvres</h1>
        <p class="lead">Explorez, gérez et découvrez des œuvres artistiques de toutes les époques et catégories.</p>
    </div>

    <!-- Section : Aperçu des fonctionnalités -->
    <div class="row mb-5">
        <div class="col-md-4 text-center">
            <i class="bi bi-collection" style="font-size: 3rem;"></i>
            <h3 class="mt-3">Gestion des Œuvres</h3>
            <p>Ajoutez, modifiez ou supprimez des œuvres tout en gardant un historique précis.</p>
        </div>
        <div class="col-md-4 text-center">
            <i class="bi bi-people" style="font-size: 3rem;"></i>
            <h3 class="mt-3">Suivi des Ventes</h3>
            <p>Suivez les transactions et gérez les ventes associées à chaque œuvre.</p>
        </div>
        <div class="col-md-4 text-center">
            <i class="bi bi-graph-up-arrow" style="font-size: 3rem;"></i>
            <h3 class="mt-3">Statistiques</h3>
            <p>Analysez les tendances de vente et la valeur des œuvres dans votre collection.</p>
        </div>
    </div>

    <!-- Section : Dernières Œuvres -->
    <div class="mb-5">
        <h2 class="mb-3">Dernières Œuvres</h2>
        <div class="row">
            @forelse($oeuvres as $oeuvre)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        @if($oeuvre->photo)
                            <img src="{{ route('private.image', ['filename' => basename($oeuvre->photo)]) }}" class="card-img-top" alt="{{ $oeuvre->nom }}">
                        @else
                            <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Image placeholder">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $oeuvre->nom }}</h5>
                            <p class="card-text">
                                <strong>Catégorie :</strong> {{ $oeuvre->categorie }}<br>
                                <strong>Année :</strong> {{ $oeuvre->annee_creation }}
                            </p>
                            <a href="{{ route('oeuvres.show', $oeuvre->id) }}" class="btn btn-primary btn-sm">Voir Détails</a>
                        </div>
                    </div>
                </div>
            @empty
                <p>Aucune œuvre ajoutée pour le moment. <a href="{{ route('oeuvres.create') }}">Ajoutez-en une</a> pour commencer.</p>
            @endforelse
        </div>
    </div>

    <!-- Section : Appel à l'action -->
    <div class="text-center mt-5">
        <h3>Prêt à enrichir votre collection ?</h3>
        <a href="{{ route('oeuvres.create') }}" class="btn btn-success btn-lg mt-3">Ajouter une Nouvelle Œuvre</a>
    </div>
</div>
@endsection
