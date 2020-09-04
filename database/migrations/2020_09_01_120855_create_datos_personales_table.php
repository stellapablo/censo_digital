<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosPersonalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_personales', function (Blueprint $table) {
            $table->id();
            $table->string('empleado_id')->index()->nullable();
            $table->string('fecha_nac')->nullable();
            $table->string('estado_civil')->nullable();
            $table->string('residencia')->nullable();
            $table->string('permiso')->nullable();
            $table->string('sexo')->nullable();
            $table->string('calle')->nullable();
            $table->string('altura')->nullable();
            $table->string('manzana')->nullable();
            $table->string('parcela')->nullable();
            $table->string('piso')->nullable();
            $table->string('dpto')->nullable();
            $table->string('barrio')->nullable();
            $table->string('localidad')->nullable();
            $table->string('celular')->nullable();
            $table->string('tel_fijo')->nullable();
            $table->string('email')->nullable();
            $table->string('tel_emergencia')->nullable();
            $table->string('pareja')->nullable();
            $table->string('hijos')->nullable();
            $table->string('menores')->nullable();
            $table->string('mayores')->nullable();
            $table->string('poliza')->nullable();
            $table->string('obra_social')->nullable();
            $table->string('fliares_cargo')->nullable();
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
        Schema::dropIfExists('datos_personales');
    }
}
