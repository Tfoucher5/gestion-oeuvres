@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="display-6">Liste des ventes</h1>
            @if(auth()->user()->isA('commissaire-priseur'))
                <a href="{{ route('ventes.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle"></i> Créer une vente
                </a>
            @endif
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(auth()->user()->isA('commissaire-priseur'))
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Lieu</th>
                            <th scope="col">Date</th>
                            <th scope="col">Montant total (€)</th>
                            <th scope="col">Commission (€)</th>
                            <th scope="col">Statut</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ventes as $vente)
                            <tr>
                                <td class="text-center">{{ $vente->id }}</td>
                                <td>{{ $vente->lieu }}</td>
                                <td>{{ \Carbon\Carbon::parse($vente->date)->format('d/m/Y') }}</td>
                                <td class="text-end">{{ number_format($vente->montant_total, 2, ',', ' ') }}</td>
                                <td class="text-end">{{ number_format($vente->commission, 2, ',', ' ') }}</td>
                                <td class="text-center">
                                    <span class="badge bg-{{ $vente->statut === 'terminee' ? 'secondary' : ($vente->statut === 'en_cours' ? 'success' : 'secondary') }}">
                                        {{ ucfirst($vente->statut) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                @if ( $vente->statut != 'terminee')
                                    <a href="{{ route('ventes.edit', $vente) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Cloturer
                                    </a>
                                    <form action="{{ route('ventes.destroy', $vente) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette vente ?')">
                                            <i class="fas fa-trash"></i> Supprimer
                                        </button>
                                    </form>
                                @else
                                    <p>Vente terminée</p>
                                @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-danger">
                Vous n'êtes pas autorisé à accéder à cette page.
            </div>
        @endif
    </div>
@endsection
