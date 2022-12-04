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
        Schema::create('household_houses', function (Blueprint $table) {
            $table->id();
            $table->integer('household_id');
            $table->year('year');
            $table->decimal('total_area', $precision = 8, $scale = 2);
            $table->decimal('total_living_area', $precision = 8, $scale = 2);
            $table->decimal('living_area', $precision = 8, $scale = 2);
            $table->decimal('room_count', $precision = 8, $scale = 2);
            $table->decimal('total_non_living_area', $precision = 8, $scale = 2);
            $table->boolean('water_supply')->default(0);
            $table->boolean('hot_water_supply')->default(0);
            $table->boolean('sewage')->default(0);
            $table->boolean('central_heating')->default(0);
            $table->boolean('individual_heating')->default(0);
            $table->boolean('furnace_heating')->default(0);
            $table->boolean('natural_gas')->default(0);
            $table->boolean('liquefied_gas')->default(0);
            $table->boolean('electric_stove')->default(0);
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
        Schema::dropIfExists('household_houses');
    }
};
