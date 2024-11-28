<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vente extends Model
{

    use HasFactory;

    protected $fillable = ['lieu', 'date', 'montant_total', 'commission', 'statut'];

    public function oeuvres()
    {
        return $this->belongsToMany(Oeuvre::class, 'oeuvre_ventes')
                    ->withPivot('prix_vente'); // Inclure la colonne supplémentaire
    }

    public function calculerMontantTotal()
    {
        $this->montant_total = $this->oeuvres->sum(function($oeuvre) {
            return $oeuvre->pivot->prix_vente;
        });
        $this->save();
    }


}
