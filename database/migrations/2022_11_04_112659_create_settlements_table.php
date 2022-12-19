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
        Schema::create('settlements', function (Blueprint $table) {
            $table->id();
            $table->integer('council_id');
            $table->integer('settlement_type_id');
            $table->string('name');
            $table->integer('inner_code');
            $table->string('postcode')->unique();
            $table->string('katottg')->unique();
            $table->timestamps();
            $table->unique(['council_id', 'inner_code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settlements');
    }
};
