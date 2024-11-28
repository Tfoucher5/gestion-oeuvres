@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4 text-center">Filtrer les œuvres pour la vente</h1>

        <form method="GET" action="{{ route('ventes.filteredResults', ['vente' => $vente->id]) }}" class="bg-light p-4 rounded shadow">
            @csrf

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="annee_debut" class="form-label">Année de début</label>
                    <input
                        type="number"
                        name="annee_debut"
                        id="annee_debut"
                        class="form-control"
                        value="{{ old('annee_debut') }}"
                        placeholder="Ex: 1900"
                    >
                </div>
                <div class="col-md-6">
                    <label for="annee_fin" class="form-label">Année de fin</label>
                    <input
                        type="number"
                        name="annee_fin"
                        id="annee_fin"
                        class="form-control"
                        value="{{ old('annee_fin') }}"
                        placeholder="Ex: 2023"
                    >
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="prix_min" class="form-label">Prix minimum</label>
                    <input
                        type="number"
                        name="prix_min"
                        id="prix_min"
                        class="form-control"
                        value="{{ old('prix_min') }}"
                        step="0.01"
                        placeholder="Ex: 100.00"
                    >
                </div>
                <div class="col-md-6">
                    <label for="prix_max" class="form-label">Prix maximum</label>
                    <input
                        type="number"
                        name="prix_max"
                        id="prix_max"
                        class="form-control"
                        value="{{ old('prix_max') }}"
                        step="0.01"
                        placeholder="Ex: 10000.00"
                    >
                </div>
            </div>

            <div class="mb-3">
                <label for="epoque" class="form-label">Époque</label>
                <input
                    type="text"
                    name="epoque"
                    id="epoque"
                    class="form-control"
                    value="{{ old('epoque') }}"
                    placeholder="Ex: Renaissance"
                >
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary w-50">Filtrer</button>
            </div>
        </form>
    </div>
@endsection
