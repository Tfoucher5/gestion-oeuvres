@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="display-6">Créer une vente</h1>
            <a href="{{ route('ventes.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Retour à la liste
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <h4 class="alert-heading">Erreurs dans le formulaire :</h4>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('ventes.store') }}" method="POST" novalidate>
                    @csrf

                    <div class="mb-3">
                        <label for="lieu" class="form-label">Lieu</label>
                        <input
                            type="text"
                            name="lieu"
                            id="lieu"
                            class="form-control @error('lieu') is-invalid @enderror"
                            value="{{ old('lieu') }}"
                            required
                            placeholder="Entrez le lieu de la vente"
                        >
                        @error('lieu')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label">Date de vente</label>
                        <input
                            type="date"
                            name="date"
                            id="date"
                            class="form-control @error('date') is-invalid @enderror"
                            value="{{ old('date') }}"
                            required
                        >
                        @error('date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check-circle"></i> Enregistrer la vente
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
