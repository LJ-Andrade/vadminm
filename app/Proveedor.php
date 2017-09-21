<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';

    protected $primaryKey = 'id';

    protected $fillable = ['nombre', 'razonsocial', 'cuit', 'ingbrutos', 'telefonos', 'email', 'direccion', 'pais', 
    'codpostal', 'notas', 'iva_id', 'localidad_id', 'provincia_id'];


    public function familias()
    {
    	return $this->hasMany('App\Familia');
    }

    public function subfamilias()
    {
    	return $this->hasMany('App\Subfamilia');
    }

    public function iva(){
    	return $this->belongsTo('App\Iva');
    }

    public function provincia(){
    	return $this->belongsTo('App\Provincia');
    }

    public function localidad(){
    	return $this->belongsTo('App\Localidad');
    }

    public function productos()
    {
    	return $this->hasMany('App\Producto');
    }

}
