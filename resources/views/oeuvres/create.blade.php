@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Ajouter une nouvelle œuvre</h1>

        <form action="{{ route('oeuvres.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-3">
                <label for="nom">Nom de l'œuvre</label>
                <input type="text" name="nom" id="nom" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="descriptif">Descriptif</label>
                <textarea name="descriptif" id="descriptif" class="form-control" required></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="photo">Photo</label>
                <input type="file" name="photo" id="photo" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="annee_creation">Année de création</label>
                <input type="number" name="annee_creation" id="annee_creation" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="categorie">Catégorie</label>
                <input type="text" name="categorie" id="categorie" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="epoque">Époque</label>
                <input type="text" name="epoque" id="epoque" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="valeur">Valeur</label>
                <input type="number" name="valeur" id="valeur" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success mt-3">Ajouter l'œuvre</button>
        </form>
    </div>
@endsection
