<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';
    protected $primaryKey = 'Id_Categoria';
    protected $fillable = ['Nombre'];

    public $timestamps = false;

}
