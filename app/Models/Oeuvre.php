<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Oeuvre extends Model
{
    use HasFactory;

    public function proprietaire() {
        return $this->belongsTo(User::class, 'proprietaire_id');
    }

    public function ventes()
    {
        return $this->belongsToMany(Vente::class, 'oeuvre_ventes')
                    ->withPivot('prix_vente'); // Inclure la colonne supplémentaire
    }

    protected $fillable = [
        'nom', 'descriptif', 'photo', 'annee_creation', 'categorie', 'style', 'valeur', 'status',
    ];

    protected $casts = [
        'annee_creation' => 'integer',
        'valeur' => 'float'
    ];

    public function getPhotoUrlAttribute()
    {
        return asset('storage/' . $this->photo);
    }
}
