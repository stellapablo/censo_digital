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
            $table->string('fecha_nac');
            $table->string('estado_civil');
            $table->string('permiso');
            $table->string('sexo');
            $table->string('calle');
            $table->string('altura');
            $table->string('manzana');
            $table->string('parcela');
            $table->string('piso');
            $table->string('dpto');
            $table->string('barrio');
            $table->string('localidad');
            $table->string('celular');
            $table->string('tel_fijo');
            $table->string('email');
            $table->string('tel_emergencia');
            $table->string('pareja');
            $table->string('hijos');
            $table->string('menores');
            $table->string('mayores');
            $table->string('poliza');
            $table->string('obra_social');
            $table->string('fliares_cargo');
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
