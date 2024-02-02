<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Vendedore
 *
 * @property $id
 * @property $alias
 * @property $codigo
 * @property $cedula
 * @property $nombre
 * @property $telefono
 * @property $correo
 * @property $imagen
 * @property $deleted_at
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Vendedore extends Model
{
    use SoftDeletes;

    static $rules = [
		'alias' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['alias','codigo','cedula','nombre','telefono','correo','imagen'];



}
