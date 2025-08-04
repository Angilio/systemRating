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
            $table->unsignedBigInteger('mention_id');
            $table->integer('annee');
            $table->integer('taux');
            $table->timestamps();

            $table->foreign('mention_id')
                ->references('id')
                ->on('mentions')
                ->onDelete('cascade');
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
