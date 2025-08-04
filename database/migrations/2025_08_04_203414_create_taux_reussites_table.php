<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('taux_reussites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mention_id')->constrained()->onDelete('cascade');
            $table->year('annee');
            $table->float('taux'); // en pourcentage, ex: 75.5
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taux_reussites');
    }
};
