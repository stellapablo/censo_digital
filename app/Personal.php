<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    protected $table  = 'datos_personales';

    protected $fillable = ['empleado_id','fecha_nac','estado_civil','permiso','sexo','calle','altura','manzana','residencia',
        'parcela','piso','dpto','barrio','localidad','celular','tel_fijo','email','tel_emergencia','pareja','hijos','menores','mayores',
        'poliza','obra_social','fliares_cargo','residencia'];
}


