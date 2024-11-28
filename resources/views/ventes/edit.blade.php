@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4 text-center">Modifier la vente #{{ $vente->id }}</h1>

        <form action="{{ route('ventes.update', $vente) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="lieu" class="form-label">Lieu</label>
                <p class="form-control-plaintext border p-2 bg-light rounded">{{ $vente->lieu }}</p>
            </div>

            <div class="mb-4">
                <label for="date" class="form-label">Date de vente</label>
                <p class="form-control-plaintext border p-2 bg-light rounded">{{ \Carbon\Carbon::parse($vente->date)->format('d/m/Y') }}</p>
            </div>

            <div class="mb-4">
                <label for="oeuvres" class="form-label">Œuvres disponibles</label>
                @foreach($vente->oeuvres as $oeuvre)
                    <div class="border rounded p-3 mb-3">
                        <h5>{{ $oeuvre->nom }}</h5>
                        <p class="text-muted">Prix estimé : <strong>{{ $oeuvre->valeur }} €</strong></p>
                        <div class="mb-3">
                            <label for="prix_vente_{{ $oeuvre->id }}" class="form-label">Prix de vente</label>
                            <input
                                type="number"
                                name="oeuvres[{{ $oeuvre->id }}][prix_vente]"
                                id="prix_vente_{{ $oeuvre->id }}"
                                class="form-control"
                                value="{{ old('oeuvres.' . $oeuvre->id . '.prix_vente', $oeuvre->pivot->prix_vente) }}"
                                step="0.01"
                            >
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mb-4">
                <label for="montant_total" class="form-label">Montant total</label>
                <p id="montant_total" class="form-control-plaintext border p-2 bg-light rounded">{{ $vente->montant_total }} €</p>
            </div>

            <div class="mb-4">
                <label for="commission" class="form-label">Commission (20%)</label>
                <p id="commission" class="form-control-plaintext border p-2 bg-light rounded">{{ $vente->commission }} €</p>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">Mettre à jour la vente</button>
            </div>
        </form>
    </div>
@endsection
