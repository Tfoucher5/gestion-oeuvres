<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OeuvreController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [OeuvreController::class, 'accueil'])->name('welcome');

//récupérer les images dans le stockage privé de Laravel
Route::get('/storage/private/{filename}', [OeuvreController::class, 'showPrivateImage'])->name('private.image');

Route::get('dashboard', [NotificationController::class, 'index'])->name('dashboard.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //routes pour les oeuvres
    Route::resource('oeuvres', OeuvreController::class);

    //Routes pour les ventes
    Route::resource('ventes', VenteController::class);

    Route::get('/ventes/{vente}/filter', [VenteController::class, 'filter'])->name('ventes.filter');
    Route::get('/ventes/{vente}/filtered-results', [VenteController::class, 'filteredResults'])->name('ventes.filteredResults');
    Route::post('/ventes/{vente}/selectOeuvres', [VenteController::class, 'selectOeuvres'])->name('ventes.selectOeuvres');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::patch('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

});

require __DIR__.'/auth.php';
