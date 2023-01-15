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
        Schema::table('household_members', function(Blueprint $table) {
            $table->integer('land_owned')->nullable()->default(0);
            $table->integer('land_rented')->nullable()->default(0);
            $table->integer('land_leased')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('household_members', function (Blueprint $table) {
            $table->dropColumn('land_owned');
        });
        Schema::table('household_members', function (Blueprint $table) {
            $table->dropColumn('land_rented');
        });
        Schema::table('household_members', function (Blueprint $table) {
            $table->dropColumn('land_leased');
        });
    }
};
