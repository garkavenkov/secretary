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
        Schema::create('household_lands', function (Blueprint $table) {
            $table->id();
            $table->integer('household_id');
            $table->year('year');

            // за цільовим призначенням
            // $table->decimal('purpose', $precision = 8, $scale = 3)->default(0);

            // для будівництва і обслуговування житлового будинку
            $table->decimal('maintenance', $precision = 8, $scale = 3)->default(0);

            // ведення особистого селянського господарства
            $table->decimal('personal_agriculture', $precision = 8, $scale = 3)->default(0);

            // ведення товарного сільськогосподарського виробництва
            $table->decimal('commercial_agriculture', $precision = 8, $scale = 3)->default(0);

            // рілля
            // $table->decimal('arable', $precision = 8, $scale = 3)->default(0);
            // багаторічні насадження
            // $table->decimal('perennial_plantations', $precision = 8, $scale = 3)->default(0);
            //пасовища
            // $table->decimal('pastures', $precision = 8, $scale = 3)->default(0);

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
        Schema::dropIfExists('household_lands');
    }
};
