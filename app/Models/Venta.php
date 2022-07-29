<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
/**
 * Class Venta
 *
 * @property $id
 * @property $tienda_id
 * @property $fventa
 * @property $fregistro
 * @property $contado
 * @property $credito
 * @property $linea_blanca
 * @property $linea_menor
 * @property $linea_marron
 * @property $aire_acondicionados
 * @property $celulares
 * @property $otros
 * @property $deleted_at
 * @property $created_at
 * @property $updated_at
 *
 * @property Tienda $tienda
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Venta extends Model
{
    use SoftDeletes,HasRoles;

    static $rules = [
		'tienda_id' => 'required',
		'fventa' => 'required',
		'fregistro' => 'required',
		'contado' => 'required',
		'credito' => 'required',
		'linea_blanca' => 'required',
		'linea_menor' => 'required',
		'linea_marron' => 'required',
		'aire_acondicionados' => 'required',
		'celulares' => 'required',
		'otros' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['tienda_id','fventa','fregistro','contado','credito','linea_blanca','linea_menor','linea_marron','aire_acondicionados','celulares','otros'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tienda()
    {
        return $this->hasOne('App\Models\Tienda', 'id', 'tienda_id');
    }
    

}
