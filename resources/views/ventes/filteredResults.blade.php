@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4 text-center">Œuvres filtrées pour la vente</h1>

        <form method="POST" action="{{ route('ventes.selectOeuvres', ['vente' => $vente->id]) }}" class="bg-light p-4 rounded shadow">
            @csrf

            <div class="form-group mb-4">
                <label for="oeuvres" class="form-label">Sélectionner les œuvres à vendre</label>
                <div class="border p-3 rounded">
                    @if($oeuvres->isEmpty())
                        <p class="text-muted">Aucune œuvre disponible pour la sélection.</p>
                    @else
                        @foreach ($oeuvres as $oeuvre)
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="oeuvres[]"
                                    value="{{ $oeuvre->id }}"
                                    id="oeuvre_{{ $oeuvre->id }}"
                                >
                                <label class="form-check-label" for="oeuvre_{{ $oeuvre->id }}">
                                    <strong>{{ $oeuvre->nom }}</strong> ({{ $oeuvre->annee_creation }})
                                    - <span class="text-success">Prix actuel : {{ number_format($oeuvre->valeur, 2) }} €</span>
                                </label>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success w-50">Sélectionner les œuvres</button>
            </div>
        </form>
    </div>
@endsection
