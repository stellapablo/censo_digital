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
            $table->id();
            $table->string('empleado_id')->index()->nullable();
            $table->string('frecuencia_cardiaca')->nullable();
            $table->string('frecuencia_respiratoria')->nullable();
            $table->string('temperatura')->nullable();
            $table->string('altura')->nullable();
            $table->string('peso')->nullable();
            $table->string('hipertension')->nullable();
            $table->string('diabetes')->nullable();
            $table->string('agudas')->nullable();
            $table->string('antitetanica')->nullable();
            $table->string('hepa')->nullable();
            $table->string('hepb')->nullable();
            $table->string('doble')->nullable();
            $table->string('antigripal')->nullable();
            $table->string('def_auditivas')->nullable();
            $table->string('def_visual')->nullable();
            $table->string('discapacidad')->nullable();
            $table->string('preocupacional')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('consulta')->nullable();
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
