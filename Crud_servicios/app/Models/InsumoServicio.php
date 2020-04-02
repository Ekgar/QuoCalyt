<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InsumoServicio extends Model
{
    protected $table = 'insumoservicio';
    protected $primaryKey = 'id_insumo';
    protected $fillable = ['Id_producto','Id_servicio','Cantidad'];
    public $timestamps = false;

}
