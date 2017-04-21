<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

    protected $table = 'productos';

    protected $primaryKey = 'id';


    protected $fillable = [ 'nombre', 'estado', 'stockactual', 'condiva', 'codproveedor', 'stockmin', 'stockmax', 'preciocompra', 'moneda_id',
                            'preciocosto', 'pjegremio', 'pjeparticular', 'pjeespecial', 'preciooferta', 'cantoferta', 'proveedor_id','familia_id', 
                            'subfamilia_id' ];
    
    public function proveedor(){
    	return $this->belongsTo('App\Proveedor');
    }
    
    public function familia(){
    	return $this->belongsTo('App\Familia');
    }

    public function subfamilia(){
    	return $this->belongsTo('App\Subfamilia');
    }

    public function moneda(){
    	return $this->belongsTo('App\Moneda');
    }

    public function pedidositems(){
    	return $this->hasMany('App\Pedidositem');
    }
}
