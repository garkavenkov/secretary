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
        Schema::create('additional_params', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('code');
            $table->string('name');
            $table->timestamps();
            $table->unique(['category_id', 'code']);
            $table->unique(['category_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('additional_params');
    }
};
