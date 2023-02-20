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
        Schema::create('household_member_lands', function (Blueprint $table) {
            $table->id();
            $table->integer('member_id');
            $table->year('year');

            // для будівництва і обслуговування житлового будинку
            $table->decimal('maintenance', $precision = 8, $scale = 4)->default(0);

            // ведення особистого селянського господарства
            $table->decimal('personal_agriculture', $precision = 8, $scale = 4)->default(0);

            //земельний пай
            $table->decimal('land_share', $precision = 8, $scale = 4)->default(0);

            //майновий пай
            $table->decimal('property_share', $precision = 8, $scale = 4)->default(0);

            // сінокосіння
            $table->decimal('hay_cutting', $precision = 8, $scale = 4)->default(0);

            //пасовища
            $table->decimal('pastures', $precision = 8, $scale = 4)->default(0);


            $table->timestamps();

            $table->unique(['member_id', 'year']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('household_member_lands');
    }
};
