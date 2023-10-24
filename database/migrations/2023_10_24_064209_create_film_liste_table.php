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
        Schema::create('film_liste', function (Blueprint $table) {
            $table->unsignedBigInteger('liste_id');
            $table->unsignedBigInteger('film_id');
            $table->primary(['liste_id', 'film_id']);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('film_liste');
    }
};
