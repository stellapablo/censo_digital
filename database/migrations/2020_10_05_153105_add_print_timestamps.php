<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrintTimestamps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agentes', function (Blueprint $table) {
            $table->timestamp('print')->nullable();

        });

        Schema::table('biometrico', function (Blueprint $table) {
            $table->integer('user_id')->index()->nullable();

        });

        Schema::table('salud', function (Blueprint $table) {
            $table->integer('user_id')->index()->nullable();

        });

        Schema::table('cargos_revista', function (Blueprint $table) {
            $table->integer('user_id')->index()->nullable();

        });

        Schema::table('datos_personales', function (Blueprint $table) {
            $table->integer('user_id')->index()->nullable();

        });

        Schema::table('formacion', function (Blueprint $table) {
            $table->integer('user_id')->index()->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agentes', function (Blueprint $table) {
            //
        });
    }
}
