@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Modifier l'Œuvre</h1>

        <form action="{{ route('oeuvres.update', $oeuvre->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="d-flex justify-content-between">
                <!-- Formulaire à gauche -->
                <div class="w-75">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom de l'œuvre</label>
                        <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $oeuvre->nom) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="descriptif" class="form-label">Descriptif</label>
                        <textarea name="descriptif" id="descriptif" class="form-control" required>{{ old('descriptif', $oeuvre->descriptif) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="annee_creation" class="form-label">Année de création</label>
                        <input type="number" name="annee_creation" id="annee_creation" class="form-control" value="{{ old('annee_creation', $oeuvre->annee_creation) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="categorie" class="form-label">Catégorie</label>
                        <input type="text" name="categorie" id="categorie" class="form-control" value="{{ old('categorie', $oeuvre->categorie) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="style" class="form-label">Style</label>
                        <input type="text" name="epoque" id="epoque" class="form-control" value="{{ old('style', $oeuvre->epoque) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="valeur" class="form-label">Valeur</label>
                        <input type="number" name="valeur" id="valeur" class="form-control" value="{{ old('valeur', $oeuvre->valeur) }}" required>
                    </div>

                    <button type="submit" class="btn btn-success">Mettre à jour l'œuvre</button>
                </div>

                <!-- Image à droite -->
                <div class="w-25 ms-4">
                    @if($oeuvre->photo)
                        <div class="mb-2">
                            <img src="{{ route('private.image', ['filename' => basename($oeuvre->photo)]) }}" alt="{{ $oeuvre->nom }}" class="img-fluid rounded" style="max-height: 400px; object-fit: cover;">
                            <p class="mt-2">Si vous souhaitez changer l'image, sélectionnez un nouveau fichier.</p>
                        </div>
                    @endif
                    <input type="file" name="photo" class="form-control">
                </div>
            </div>
        </form>
    </div>
@endsection
