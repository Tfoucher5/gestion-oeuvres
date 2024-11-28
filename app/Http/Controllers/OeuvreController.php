<?php

namespace App\Http\Controllers;

use App\Models\Oeuvre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Silber\Bouncer\BouncerFacade as Bouncer;

class OeuvreController extends Controller
{
    // Afficher toutes les œuvres
    public function index()
    {
        if (auth()->user()->isA('proprietaire'))
        {
            $oeuvres = Oeuvre::where('proprietaire_id', auth()->user()->id)->get();

            return view('oeuvres.index', compact('oeuvres'));
        } else {
            $oeuvres = Oeuvre::all();

            return view('oeuvres.index', compact('oeuvres'));
        }


    }

    // Afficher les détails d'une œuvre
    public function show(Oeuvre $oeuvre)
    {
        return view('oeuvres.show', compact('oeuvre'));
    }


    // Afficher le formulaire pour créer une nouvelle œuvre
    public function create()
    {
        return view('oeuvres.create');
    }

    // Sauvegarder une nouvelle œuvre
    public function store(Request $request)
    {
        // Vérifier si l'utilisateur est authentifié
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour ajouter une œuvre.');
        }

        // Validation des données
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'descriptif' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'annee_creation' => 'required|integer',
            'categorie' => 'required|string',
            'epoque' => 'required|string',
            'valeur' => 'required|numeric',
        ]);

        // Gérer l'upload de la photo
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('images');
        } else {
            $photoPath = null;
        }

        // Créer l'œuvre avec l'id de l'utilisateur authentifié
        $oeuvre = new Oeuvre;
        $oeuvre->nom = $validated['nom'];
        $oeuvre->descriptif = $validated['descriptif'];
        $oeuvre->photo = $photoPath;
        $oeuvre->annee_creation = $validated['annee_creation'];
        $oeuvre->categorie = $validated['categorie'];
        $oeuvre->epoque = $validated['epoque'];
        $oeuvre->valeur = $validated['valeur'];
        $oeuvre->status = 'disponible';
        $oeuvre->proprietaire_id = auth()->user()->id;
        $oeuvre->save();

        return redirect()->route('oeuvres.index')->with('success', 'Œuvre ajoutée avec succès.');
    }

    // Afficher le formulaire pour modifier une œuvre
    public function edit(Oeuvre $oeuvre)
    {
        return view('oeuvres.edit', compact('oeuvre'));
    }

    // Mettre à jour une œuvre existante
    public function update(Request $request, Oeuvre $oeuvre)
    {
        // Gérer l'upload de la photo si présente
        if ($request->hasFile('photo')) {
            // Supprimer l'ancienne photo si elle existe
            if ($oeuvre->photo) {
                \Storage::delete($oeuvre->photo);
            }
            // Stocker la nouvelle photo
            $photoPath = $request->file('photo')->store('private/photos');
        } else {
            // Conserver l'ancienne photo si aucune nouvelle photo n'est téléchargée
            $photoPath = $oeuvre->photo;
        }

        // Validation des données reçues
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'descriptif' => 'required|string|max:1000',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Photo est facultative
            'annee_creation' => 'required|integer',
            'categorie' => 'required|string|max:255',
            'epoque' => 'nullable|string|max:255',  // Si époqe est facultatif
            'valeur' => 'required|numeric',
        ]);

        // Mettre à jour l'œuvre avec les données validées
        $oeuvre->nom = $validated['nom'];
        $oeuvre->descriptif = $validated['descriptif'];
        $oeuvre->photo = $photoPath; // La photo est mise à jour ou conservée
        $oeuvre->annee_creation = $validated['annee_creation'];
        $oeuvre->categorie = $validated['categorie'];
        $oeuvre->epoque = $validated['epoque'] ?? 'Inconnu'; // Si 'epoque' est vide, utiliser 'Inconnu'
        $oeuvre->valeur = $validated['valeur'];
        $oeuvre->save();

        return redirect()->route('oeuvres.index')->with('success', 'Œuvre mise à jour avec succès.');
    }

    // Supprimer une œuvre
    public function destroy(Oeuvre $oeuvre)
    {
        // Supprimer la photo si elle existe
        if ($oeuvre->photo) {
            \Storage::delete($oeuvre->photo);
        }

        // Supprimer l'œuvre
        $oeuvre->delete();

        return redirect()->route('oeuvres.index')->with('success', 'Œuvre supprimée avec succès.');
    }

    public function showPrivateImage($filename)
    {
        // Définir le chemin de l'image
        $path = storage_path('app/private/images/' . $filename);

        // Vérifier si le fichier existe
        if (!file_exists($path)) {
            abort(404); // Si le fichier n'existe pas, retourner une erreur 404
        }

        // Retourner le fichier avec le bon type MIME
        return response()->file($path);
    }
}
