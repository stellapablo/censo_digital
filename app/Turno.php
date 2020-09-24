<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    protected $table = 'turnos';

    protected $fillable = ['nrouag','fecha','turno'];

    public $timestamps = false;

}
