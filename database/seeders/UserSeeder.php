<?php

namespace Database\Seeders;

use App\Models\User;
use Bouncer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Créer les rôles avec Bouncer
        Bouncer::allow('proprietaire')->to('create', User::class);
        Bouncer::allow('commissaire-priseur')->to('manage', User::class);

        // Créer un utilisateur avec le rôle de commissaire-priseur
        $commissaire = User::create([
            'name' => 'Commisaire Priseur',
            'email' => 'commissaire@exemple.com',
            'password' => Hash::make('totototo'),
        ]);
        Bouncer::assign('commissaire-priseur')->to($commissaire);

        // Créer deux utilisateurs avec le rôle de proprietaire
        $proprietaire1 = User::create([
            'name' => 'Propriétaire 1',
            'email' => 'proprietaire1@exemple.com',
            'password' => Hash::make('totototo'),
        ]);
        Bouncer::assign('proprietaire')->to($proprietaire1);

        $proprietaire2 = User::create([
            'name' => 'Propriétaire 2',
            'email' => 'proprietaire2@exemple.com',
            'password' => Hash::make('totototo'),
        ]);
        Bouncer::assign('proprietaire')->to($proprietaire2);
    }
}
