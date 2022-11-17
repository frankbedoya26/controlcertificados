<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registralumno extends Model
{
    protected $table = 'certificados.alumcacip';
	protected $fillable = ['dni','codigo','ape','nom','correo','telefo','carrera','direccon','direccon','tipo'];
	protected $guarded = ['id'];


}
