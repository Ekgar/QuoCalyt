<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table = 'servicio';
    protected $primaryKey = 'Id_servicio';
    protected $fillable = ['Nombre','Valor','Cantidad','Id_Categoria'];

    public $timestamps = false;
}
