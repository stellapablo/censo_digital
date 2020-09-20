<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $table = 'formacion';

    protected $fillable = ['empleado_id','nombre','nivel_id','formacion_id'];
}
