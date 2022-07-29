<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parroquia extends Model
{
    public $timestamps = false;

    protected $table = 'parroquias';
    protected $fillable = [
        'id_municipio',
        'parroquia'
    ];


}
