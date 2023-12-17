<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalFieldsToFilmsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('films', function (Blueprint $table) {
            $table->text('overview')->nullable();
            $table->string('companyNames')->nullable();
            $table->string('genres')->nullable();
            $table->integer('runtime')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('films', function (Blueprint $table) {
            $table->dropColumn('overview');
            $table->dropColumn('companyNames');
            $table->dropColumn('genres');
            $table->dropColumn('runtime');
        });
    }
}

