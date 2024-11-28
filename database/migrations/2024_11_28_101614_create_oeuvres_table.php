<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('oeuvres', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('descriptif');
            $table->string('photo')->nullable();
            $table->integer('annee_creation');
            $table->string('categorie')->default('non renseigné');
            $table->string('epoque')->default('non renseigné');
            $table->decimal('valeur', 15, 2);
            $table->enum('status', ['disponible', 'en_vente', 'vendue'])->default('disponible');
            $table->foreignId('proprietaire_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oeuvres');
    }
};
