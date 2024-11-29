@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Liste des Œuvres</h1>

    <!-- Affichage des messages flash -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(auth()->user()->isA('proprietaire'))
        <a href="{{ route('oeuvres.create') }}" class="btn btn-primary mb-3">Ajouter une œuvre</a>
    @endif

    <table id="oeuvresTable" class="table table-striped">
        <thead>
            <tr>
                <th class="text-center">Nom</th>
                <th class="text-center">Descriptif</th>
                <th class="text-center">Année</th>
                <th class="text-center">Catégorie</th>
                <th class="text-center">Époque</th>
                <th class="text-center">Prix</th>
                <th class="text-center">Status</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($oeuvres as $oeuvre)
                <tr>
                    <td>{{ $oeuvre->nom }}</td>
                    <td>{{ $oeuvre->descriptif }}</td>
                    <td>{{ $oeuvre->annee_creation }}</td>
                    <td>{{ $oeuvre->categorie }}</td>
                    <td>{{ $oeuvre->epoque }}</td>
                    <td>{{ number_format($oeuvre->valeur, 2, ',', ' ') }} €</td>
                    <td>
                        @if($oeuvre->status == 'disponible')
                            <span class="badge bg-success">Disponible</span>
                        @elseif ($oeuvre->status == 'en_vente')
                            <span class="badge bg-warning">En Vente</span>
                        @else
                            <span class="badge bg-danger">Vendue</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('oeuvres.show', $oeuvre->id) }}" class="btn btn-info btn-sm me-2">
                            <i class="fas fa-eye"></i> Voir
                        </a>
                        @if(auth()->user()->isA('proprietaire') && ($oeuvre->status != 'vendue'))
                            <a href="{{ route('oeuvres.edit', $oeuvre->id) }}" class="btn btn-warning btn-sm me-2">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                            <!-- Formulaire de suppression avec confirmation -->
                            <form action="{{ route('oeuvres.destroy', $oeuvre->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette œuvre ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Supprimer
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
