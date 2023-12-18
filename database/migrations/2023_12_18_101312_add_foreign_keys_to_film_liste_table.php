<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('film_liste', function (Blueprint $table) {
            // Ajout des clés étrangères
            $table->foreign('liste_id')->references('id')->on('listes')->onDelete('cascade');
            $table->foreign('film_id')->references('id')->on('films')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('film_liste', function (Blueprint $table) {
            // Suppression des clés étrangères
            $table->dropForeign(['liste_id']);
            $table->dropForeign(['film_id']);
        });
    }
};
