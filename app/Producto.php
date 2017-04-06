<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

    protected $table = 'productos';

    protected $primaryKey = 'id';

    protected $fillable = [ 'nombre', 'unidad', 'estado', 'stockactual', 'stockmin', 'stockmax', 'preciocompra', 'preciocosto',
                            'preciogremio', 'precioparticular', 'precioespecial', 'preciooferta', 'proveedor_id', 'familia_id', 'subfamilia_id'];
    
    public function proveedor(){
    	return $this->belongsTo('App\Proveedor');
    }
    
    public function familias(){
    	return $this->belongsTo('App\Familia');
    }

    public function subfamilias(){
    	return $this->belongsTo('App\Subfamilia');
    }
}
