<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CargoRevista extends Model
{
    protected $table = 'cargos_revista';

    protected $fillable = ['revista_id','haberes','motivo','reloj_id','area_id','mañana','tarde','noche','empleado_id','area_nueva','reloj_nuevo',];

}
