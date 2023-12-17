<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalFieldsToSeriesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('series', function (Blueprint $table) {
            $table->text('overview')->nullable();
            $table->string('companyNames')->nullable();
            $table->string('genres')->nullable();
            $table->integer('runtime')->nullable();
            $table->integer('number_of_seasons')->nullable();
            $table->integer('number_of_episodes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('series', function (Blueprint $table) {
            $table->dropColumn('overview');
            $table->dropColumn('companyNames');
            $table->dropColumn('genres');
            $table->dropColumn('runtime');
            $table->dropColumn('number_of_seasons');
            $table->dropColumn('number_of_episodes');
        });
    }
}

