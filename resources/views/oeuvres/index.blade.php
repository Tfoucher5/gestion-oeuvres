@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Liste des Œuvres</h1>

        <!-- Ajouter une œuvre -->
        <a href="{{ route('oeuvres.create') }}" class="btn btn-primary mb-3">Ajouter une œuvre</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Descriptif</th>
                    <th>Année</th>
                    <th>Catégorie</th>
                    <th>Époque</th>
                    <th>Prix</th>
                    <th>Status</th>
                    <th>Actions</th>
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
                            @if($oeuvre->status)
                                <span class="badge bg-success">Disponible</span>
                            @else
                                <span class="badge bg-danger">Indisponible</span>
                            @endif
                        </td>
                        <td class="d-flex justify-content-start">
                            <a href="{{ route('oeuvres.show', $oeuvre->id) }}" class="btn btn-info btn-sm me-2">
                                <i class="fas fa-eye"></i> Voir
                            </a>
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
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
