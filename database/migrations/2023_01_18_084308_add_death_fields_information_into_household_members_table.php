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
            $table->date('death_date')->nullable();
            $table->string('death_register_number')->nullable();
            $table->string('death_register_office')->nullable();
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
            $table->dropColumn('death_date');
        });
        Schema::table('household_members', function (Blueprint $table) {
            $table->dropColumn('death_register_number');
        });
        Schema::table('household_members', function (Blueprint $table) {
            $table->dropColumn('death_register_office');
        });
    }
};
