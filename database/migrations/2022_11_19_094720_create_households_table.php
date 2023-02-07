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
        Schema::create('households', function (Blueprint $table) {
            $table->id();
            $table->integer('settlement_id');
            $table->integer('household_type_id');
            $table->string('address');
            $table->integer('number');
            $table->string('special_marks')->nullable();
            $table->string('additional_data')->nullable();
            $table->timestamps();
            $table->unique(['settlement_id', 'address']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('households');
    }
};
