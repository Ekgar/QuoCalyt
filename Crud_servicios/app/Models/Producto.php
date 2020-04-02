<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto';
    protected $primaryKey = 'Id_producto';
    protected $fillable = ['Nombre','precio','cantidad'];

    public $timestamps = false;
}
