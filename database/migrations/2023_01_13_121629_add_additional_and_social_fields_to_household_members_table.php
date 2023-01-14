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
        Schema::table('household_members', function (Blueprint $table) {
            $table->string('social_information')->nullable()->default('');
            $table->string('additional_information')->nullable()->default('');
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
            $table->dropColumn('social_information');
        });
        Schema::table('household_members', function (Blueprint $table) {
            $table->dropColumn('additional_information');
        });
    }
};
