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
        Schema::create('household_members', function (Blueprint $table) {
            $table->id();
            $table->integer('household_id');
            $table->string('surname');
            $table->string('name');
            $table->string('patronymic');
            $table->enum('sex',['чоловіча','жіноча']);
            $table->date('birthdate');
            $table->integer('family_relationship_type_id');
            $table->string('employment_information')->nullable();
            $table->integer('work_place_id')->nullable();
            $table->string('social_information')->nullable()->default('');
            $table->string('additional_information')->nullable()->default('');
            $table->integer('land_owned')->nullable()->default(0);
            $table->integer('land_rented')->nullable()->default(0);
            $table->integer('land_leased')->nullable()->default(0);
            $table->date('death_date')->nullable();
            $table->string('death_register_number')->nullable();
            $table->string('death_register_office')->nullable();
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
        Schema::dropIfExists('household_members');
    }
};
