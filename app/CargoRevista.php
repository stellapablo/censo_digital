<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CargoRevista extends Model
{
    protected $table = 'cargos_revista';

    protected $fillable = ['revista_id','haberes','motivo','subroga_en','trabaja_en','mañana','tarde','noche','empleado_id'];

}
