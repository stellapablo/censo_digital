<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCargosRevistaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargos_revista', function (Blueprint $table) {
            $table->id();
            $table->string('revista_id')->index()->nullable();
            $table->string('haberes')->nullable();
            $table->string('motivo')->nullable();
            $table->string('subroga_en')->index()->nullable();
            $table->string('trabaja_en')->index()->nullable();
            $table->string('mañana')->nullable();
            $table->string('tarde')->nullable();
            $table->string('noche')->nullable();
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
        Schema::dropIfExists('cargos_revista');
    }
}
