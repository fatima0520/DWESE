<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    //nombre de la tabla
    protected $table='profesor';
    //campos que hay qu erellenar antes de guardar un objeto en la base de datos
    protected $fillable = ['nombre','apellidos','especialidad','fecha_alta','salario'];
}
