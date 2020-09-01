<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStepMedicaTableEmpleados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salud', function (Blueprint $table) {
            $table->bigIncrements();
            $table->string('empleado_id')->index()->nullable();
            $table->string('frecuencia_cardiaca');
            $table->string('frecuencia_respiratoria');
            $table->string('temperatura');
            $table->string('altura');
            $table->string('peso');
            $table->string('hipertension');
            $table->string('diabetes');
            $table->string('agudas');
            $table->string('antitetanica');
            $table->string('hepa');
            $table->string('hepb');
            $table->string('doble');
            $table->string('antigripal');
            $table->string('def_auditivas');
            $table->string('def_visual');
            $table->string('discapacidad');
            $table->string('preocupacional');
            $table->string('observaciones');
            $table->string('consulta');
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
        Schema::dropIfExists('salud');
    }
}
