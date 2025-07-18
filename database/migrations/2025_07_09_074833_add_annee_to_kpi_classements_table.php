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
        Schema::table('kpi_classements', function (Blueprint $table) {
            Schema::table('kpi_classements', function (Blueprint $table) {
                $table->year('annee')->default(date('Y'));
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kpi_classements', function (Blueprint $table) {
            //
        });
    }
};
