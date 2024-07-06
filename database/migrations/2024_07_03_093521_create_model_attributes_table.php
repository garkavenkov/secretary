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
        Schema::create('model_attributes', function (Blueprint $table) {
            $table->id();
            $table->string('model');
            $table->string('code');
            $table->string('name');
            $table->string('available_values')->nullable()->default('');
            $table->string('conditions')->nullable()->default('');
            $table->timestamps();

            $table->unique(['model','code']);
            $table->unique(['model','name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_attributes');
    }
};
