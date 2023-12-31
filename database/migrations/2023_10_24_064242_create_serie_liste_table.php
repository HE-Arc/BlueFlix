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
        Schema::create('serie_list', function (Blueprint $table) {
            $table->unsignedBigInteger('list_id');
            $table->unsignedBigInteger('serie_id');
            $table->primary(['list_id', 'serie_id']);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serie_list');
    }
};
