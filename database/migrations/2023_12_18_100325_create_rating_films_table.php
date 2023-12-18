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
       Schema::create('rating_films', function (Blueprint $table) {
           $table->unsignedBigInteger('film_id');
           $table->unsignedBigInteger('user_id');
           $table->integer('rating');

           // Clés étrangères
           $table->foreign('film_id')->references('id')->on('films')->onDelete('cascade');
           $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

           // Clé primaire composite
           $table->primary(['film_id', 'user_id']);

           $table->timestamps();
       });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
       Schema::dropIfExists('rating_films');
   }
};
