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
        Schema::table('serie_list', function (Blueprint $table) {
            // Ajout des clés étrangères
            $table->foreign('list_id')->references('id')->on('lists')->onDelete('cascade');
            $table->foreign('serie_id')->references('id')->on('series')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('serie_list', function (Blueprint $table) {
            // Suppression des clés étrangères
            $table->dropForeign(['list_id']);
            $table->dropForeign(['serie_id']);
        });
    }
};
