<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biometria extends Model
{
    protected $table = 'biometrico';

    protected $fillable = ['imagen','empĺeado_id '];

}
