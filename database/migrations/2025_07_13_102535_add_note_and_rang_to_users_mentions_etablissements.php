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
        Schema::table('users', function (Blueprint $table) {
            $table->float('note')->nullable();
        });

        Schema::table('mentions', function (Blueprint $table) {
            $table->float('note')->nullable();
            $table->integer('rang')->nullable();
        });

        Schema::table('etablissements', function (Blueprint $table) {
            $table->float('note')->nullable();
            $table->integer('rang')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users_mentions_etablissements', function (Blueprint $table) {
            
        });
    }
};
