<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargosAgentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargos_agentes', function (Blueprint $table) {
            $table->id();
            $table->string('planta')->index()->nullable();
            $table->string('')->index()->nullable();
            $table->string('nombre')->index()->nullable();
            $table->string('nombre')->index()->nullable();
            $table->string('nombre')->index()->nullable();
            $table->string('nombre')->index()->nullable();
            $table->string('nombre')->index()->nullable();

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
        Schema::dropIfExists('cargos_agentes');
    }
}
