<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formacion', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->integer('empleado_id')->index()->nullable();
            $table->string('formacion_id')->index()->nullable();
            $table->string('nivel_id')->index()->nullable();
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
        Schema::dropIfExists('formacion');
    }
}
