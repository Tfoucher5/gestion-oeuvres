<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use App\Models\Oeuvre;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VenteConfirmation;
use App\Notifications\OeuvrePlacedInVente;
use App\Notifications\OeuvreVenduNotification;

class VenteController extends Controller
{
    // Affichage de la liste des ventes
    public function index()
    {
        if (auth()->user()->isA('commissaire-priseur')) {
            $ventes = Vente::all();  // Vous pouvez ajouter des filtres ou paginer les résultats si nécessaire
            return view('ventes.index', compact('ventes'));
        } else {
            return redirect()->route('oeuvres.index')->with('error', 'Pas d\'autorisation');
        }
    }

    public function create(Request $request)
    {
        if (auth()->user()->isA('commissaire-priseur')) {
            return view('ventes.create');
        } else {
            return redirect()->route('oeuvres.index')->with('error', 'Pas d\'autorisation');
        }

    }

    public function store(Request $request)
    {
        if (auth()->user()->isA('commissaire-priseur')) {

            // Validation des données
            $request->validate([
                'lieu' => 'required|string',
                'date' => 'required|date',
            ]);

            // Enregistrement de la vente
            $vente = new Vente();
            $vente->lieu = $request->lieu;
            $vente->date = $request->date;
            $vente->save();

            // Redirection vers la page de filtrage des œuvres
            return redirect()->route('ventes.filter', ['vente' => $vente->id]);

        } else {
            return redirect()->route('oeuvres.index')->with('error', 'Pas d\'autorisation');
        }
    }

    public function edit(Vente $vente, Request $request)
    {
        if (auth()->user()->isA('commissaire-priseur')) {
        $oeuvres = Oeuvre::all();
        return view('ventes.edit', compact('vente', 'oeuvres'));
        } else {
            return redirect()->route('oeuvres.index')->with('error', 'Pas d\'autorisation');
        }
    }

    public function update(Request $request, Vente $vente)
    {
        if (auth()->user()->isA('commissaire-priseur')) {
            // Validation des données du formulaire
            $validated = $request->validate([
                'oeuvres' => 'required|array', // Validation des œuvres
                'oeuvres.*.prix_vente' => 'nullable|numeric', // Validation des prix de vente des œuvres
            ]);

            // Calcul du montant total et de la commission
            $montantTotal = 0;
            foreach ($validated['oeuvres'] as $oeuvreId => $data) {
                $prixVente = $data['prix_vente'] ?? 0; // Prix de vente de chaque œuvre

                if ($prixVente == 0) {
                    // Si le prix est à 0, on détache l'œuvre de la vente
                    $vente->oeuvres()->detach($oeuvreId);

                    // Mettre à jour le statut de l'œuvre à "disponible"
                    $oeuvre = Oeuvre::findOrFail($oeuvreId);
                    $oeuvre->status ='disponible';
                    $oeuvre->save();
                } else {
                    // Si le prix est supérieur à 0, on met à jour le prix de vente dans la table pivot
                    $vente->oeuvres()->updateExistingPivot($oeuvreId, [
                        'prix_vente' => $prixVente,
                    ]);
                    $montantTotal += $prixVente;

                    // Notifier le propriétaire de la vente
                    $oeuvre = Oeuvre::findOrFail($oeuvreId);
                    $proprietaire = $oeuvre->proprietaire; // Relation vers le propriétaire
                    $proprietaire->notify(new OeuvreVenduNotification($oeuvre, $prixVente));

                    // Mettre à jour le statut de l'œuvre à "disponible"
                    $oeuvre = Oeuvre::findOrFail($oeuvreId);
                    $oeuvre->status ='vendue';
                    $oeuvre->save();
                }

            }

            // Calcul de la commission (20%)
            $commission = $montantTotal * 0.20;

            // Mise à jour du montant total et de la commission dans la vente
            $vente->montant_total = $montantTotal;
            $vente->commission = $commission;
            $vente->statut = 'terminee';
            $vente->save();

            // Redirection vers la liste des ventes avec un message de succès
            return redirect()->route('ventes.index')->with('success', 'Vente mise à jour avec succès.');

        } else {
            return redirect()->route('oeuvres.index')->with('error', 'Pas d\'autorisation');
        }
    }

    // Suppression d'une vente
    public function destroy(Vente $vente)
    {
        if (auth()->user()->isA('commissaire-priseur')) {
            // Suppression des associations avec les œuvres
            $vente->oeuvres()->detach();

            // Suppression de la vente
            $vente->delete();

            return redirect()->route('ventes.index')->with('success', 'Vente supprimée avec succès.');
        } else {
            return redirect()->route('oeuvres.index')->with('error', 'Pas d\'autorisation');
        }
    }

    public function filter($venteId)
    {
        if (auth()->user()->isA('commissaire-priseur')) {
            $vente = Vente::findOrFail($venteId);
            return view('ventes.filter', compact('vente'));
        } else {
            return redirect()->route('oeuvres.index')->with('error', 'Pas d\'autorisation');
        }
    }


    public function filteredResults(Request $request, $venteId)
    {
        if (auth()->user()->isA('commissaire-priseur')) {
            $vente = Vente::findOrFail($venteId);

            $query = Oeuvre::query();

            // Filtrage par année de création
            if ($request->filled('annee_debut') && $request->filled('annee_fin')) {
                $query->whereBetween('annee_creation', [(int) $request->annee_debut, (int) $request->annee_fin]);
            }

            // Filtrage par prix
            if ($request->filled('prix_min') && $request->filled('prix_max')) {
                $query->whereBetween('valeur', [(float) $request->prix_min, (float) $request->prix_max]);
            }

            // Filtrage par époque
            if ($request->filled('epoque')) {
                $query->where('epoque', 'LIKE', '%' . $request->epoque . '%');
            }

            // Exclure les œuvres déjà attachées à une autre vente
            $query->whereDoesntHave('ventes', function($q) use ($venteId) {
                $q->where('ventes.id', '!=', $venteId);
            });

            // Récupérer les œuvres filtrées
            $oeuvres = $query->get();

            return view('ventes.filteredResults', compact('vente', 'oeuvres'));
        } else {
            return redirect()->route('oeuvres.index')->with('error', 'Pas d\'autorisation');
        }
    }


    public function selectOeuvres(Request $request, $venteId)
    {

        if (auth()->user()->isA('commissaire-priseur')) {
            // Récupérer la vente à partir de l'ID
            $vente = Vente::findOrFail($venteId);

            // Validation des œuvres sélectionnées
            $request->validate([
                'oeuvres' => 'required|array',
                'oeuvres.*' => 'exists:oeuvres,id', // Vérifier que les IDs des œuvres existent
            ]);

            // Enregistrer les œuvres sélectionnées pour cette vente
            foreach ($request->oeuvres as $oeuvreId) {
                // Attacher chaque œuvre à la vente dans la table pivot
                $vente->oeuvres()->attach($oeuvreId);

                // Mettre à jour le statut de l'œuvre à "en_vente"
                $oeuvre = Oeuvre::findOrFail($oeuvreId);
                $oeuvre->status ='en_vente';
                $oeuvre->save();

                // Récupérer l'œuvre et le propriétaire
                $oeuvre = Oeuvre::findOrFail($oeuvreId);
                $proprietaire = $oeuvre->proprietaire;

                $proprietaire->notify(new OeuvrePlacedInVente($oeuvre, $vente));
            }

            // Redirection vers la page des ventes avec un message de succès
            return redirect()->route('ventes.index')->with('success', 'Œuvres ajoutées à la vente avec succès.');
        } else {
            return redirect()->route('oeuvres.index')->with('error', 'Pas d\'autorisation');
        }
    }


}
