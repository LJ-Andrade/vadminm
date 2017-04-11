<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

    protected $table = 'productos';

    protected $primaryKey = 'id';


    protected $fillable = [ 'nombre', 'stockactual', 'condiva', 'codproveedor', 'stockmin', 'stockmax', 'preciocompra',
                            'preciocosto', 'pjegremio', 'pjeparticular', 'pjeespecial', 'preciooferta', 'cantoferta', 'estado', 'proveedor_id','familia_id', 
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
}
