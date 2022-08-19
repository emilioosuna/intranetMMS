<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
/**
 * Class VentasVendedore
 *
 * @property $id
 * @property $tienda_id
 * @property $fdesde
 * @property $fdhasta
 *
 * @property Tienda $tienda
 * @property VentasVendedorDetalle[] $ventasVendedorDetalles
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class VentasVendedore extends Model
{
     use SoftDeletes;
    
    static $rules = [
		'tienda_id' => 'required',
		'fdesde' => 'required',
		'fdhasta' => 'required',
        'prueba' => ['required','mimes:csv,txt','max:2048'],
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['tienda_id','fdesde','fdhasta'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tienda()
    {
        return $this->hasOne('App\Models\Tienda', 'id', 'tienda_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ventasVendedorDetalles()
    {
        return $this->hasMany('App\Models\VentasVendedorDetalle', 'vvid', 'id');
    }
    

}
