<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Incidencia
 *
 * @property $id
 * @property $tipo_incidencia_id
 * @property $incidencia
 * @property $equipo_incidencia_id
 * @property $created_at
 * @property $updated_at
 *
 * @property IncidenciasDetalle[] $incidenciasDetalles
 * @property InventarioEquipo $inventarioEquipo
 * @property ObservacionesIncidencia[] $observacionesIncidencias
 * @property TipoIncidencia $tipoIncidencia
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Incidencia extends Model
{
    
    static $rules = [
		'tipo_incidencia_id' => 'required',
		'incidencia' => 'required',
		'equipo_incidencia_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['tipo_incidencia_id','incidencia','equipo_incidencia_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function incidenciasDetalles()
    {
        return $this->hasMany('App\Models\IncidenciasDetalle', 'incidencia_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function inventarioEquipo()
    {
        return $this->hasOne('App\Models\InventarioEquipo', 'id', 'equipo_incidencia_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function observacionesIncidencias()
    {
        return $this->hasMany('App\Models\ObservacionesIncidencia', 'incidencia_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tipoIncidencia()
    {
        return $this->hasOne('App\Models\TipoIncidencia', 'id', 'tipo_incidencia_id');
    }
    

}
