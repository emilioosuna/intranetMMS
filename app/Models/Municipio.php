<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    public $timestamps = false;

    protected $table = 'municipios';
    protected $fillable = [
        'id_estado',
        'municipio'
    ];


}
