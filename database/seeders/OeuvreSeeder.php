<?php

namespace Database\Seeders;

use App\Models\Oeuvre;
use Illuminate\Database\Seeder;
use App\Models\User;
use Silber\Bouncer\BouncerFacade as Bouncer;

class OeuvreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Création des œuvres avec des données réalistes
        Oeuvre::create([
            'nom' => 'La Joconde',
            'descriptif' => 'Peinture de Léonard de Vinci, représentant une femme avec un sourire énigmatique.',
            'photo' => 'private/photos/joconde.jpg',
            'annee_creation' => 1503,
            'categorie' => 'Peinture',
            'epoque' => 'Renaissance',
            'valeur' => 850000000,  // Estimée à 850 millions d\'euros
            'status' => 'disponible',
            'proprietaire_id' => 2,
        ]);

        Oeuvre::create([
            'nom' => 'Le Cri',
            'descriptif' => 'Peinture de Edvard Munch représentant une silhouette sur un pont dans un paysage tumultueux.',
            'photo' => 'private/photos/le_cri.jpg',
            'annee_creation' => 1893,
            'categorie' => 'Peinture',
            'epoque' => 'Expressionnisme',
            'valeur' => 119900000,  // Estimée à 119 millions de dollars
            'status' => 'disponible',
            'proprietaire_id' => 2,
        ]);

        Oeuvre::create([
            'nom' => 'Les Nympheas',
            'descriptif' => 'Série de peintures de Claude Monet représentant des nénuphars dans son jardin à Giverny.',
            'photo' => 'private/photos/nympheas.jpg',
            'annee_creation' => 1916,
            'categorie' => 'Peinture',
            'epoque' => 'Impressionnisme',
            'valeur' => 50000000,  // Estimée à 50 millions de dollars
            'status' => 'disponible',
            'proprietaire_id' => 3,
        ]);

        Oeuvre::create([
            'nom' => 'La Nuit étoilée',
            'descriptif' => 'Peinture de Vincent van Gogh représentant un ciel nocturne avec des étoiles tourbillonnantes.',
            'photo' => 'private/photos/nuit_etoilee.jpg',
            'annee_creation' => 1889,
            'categorie' => 'Peinture',
            'epoque' => 'Post-impressionnisme',
            'valeur' => 107000000,  // Estimée à 107 millions de dollars
            'status' => 'disponible',
            'proprietaire_id' => 3,
        ]);

        Oeuvre::create([
            'nom' => 'Le Baiser',
            'descriptif' => 'Sculpture en marbre de Rodin représentant deux amants dans un geste tendre.',
            'photo' => 'private/photos/baiser.jpg',
            'annee_creation' => 1889,
            'categorie' => 'Sculpture',
            'epoque' => 'Modernisme',
            'valeur' => 28000000,  // Estimée à 28 millions de dollars
            'status' => 'disponible',
            'proprietaire_id' => 3,
        ]);

    }
}
