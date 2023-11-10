<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FacturasVendedore
 *
 * @property $id
 * @property $tienda_id
 * @property $fdesde
 * @property $fdhasta
 * @property $deleted_at
 * @property $created_at
 * @property $updated_at
 *
 * @property FacturasVendedoreDetalle[] $facturasVendedoreDetalles
 * @property Tienda $tienda
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class FacturasVendedore extends Model
{
    use SoftDeletes;

    static $rules = [
		'tienda_id' => 'required',
		'fdesde' => 'required',
		'fdhasta' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['tienda_id','fdesde','fdhasta'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function facturasVendedoreDetalles()
    {
        return $this->hasMany('App\Models\FacturasVendedoreDetalle', 'fvid', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tienda()
    {
        return $this->hasOne('App\Models\Tienda', 'id', 'tienda_id');
    }
    

}
