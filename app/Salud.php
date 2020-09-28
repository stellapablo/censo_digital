<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salud extends Model
{
    protected $table = 'salud';

    protected $fillable = ['empleado_id','frecuencia_cardiaca','frecuencia_respiratoria','temperatura','altura','peso','hipertension',
        'diabetes','agudas','antitetanica','hepa','hepb','antigripal','def_auditivas','def_visual','discapacidad','preocupacional','observaciones','consulta','sistole','diastole'];

    public function agente(){
        return $this->belongsTo('App\Agente','NROUAG','empleado_id');
    }
}
