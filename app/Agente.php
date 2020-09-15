<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agente extends Model
{
    protected $table ='agentes';

    public $timestamps = false;

    protected $fillable = ['APYNOM','DOCUME','CUILAG','AREA','DENARE','DOMICI','SEXOARG','EDADAG','FECNAC','FECING','GRUPO','AREITE','posta1','posta2','posta3'];

}
