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
        Schema::table('reports', function (Blueprint $table) {
            $table->renameColumn('name', 'code');
        });

        Schema::table('reports', function (Blueprint $table) {
            $table->renameColumn('description', 'name');
        });

        Schema::table('reports', function (Blueprint $table) {
            $table->renameColumn('path', 'file_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->renameColumn('file_name', 'path');
        });
        
        Schema::table('reports', function (Blueprint $table) {
            $table->renameColumn('name', 'description');
        });

        Schema::table('reports', function (Blueprint $table) {
            $table->renameColumn('code', 'name');
        });
    }
};
