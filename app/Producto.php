<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

    protected $table = 'productos';

    protected $primaryKey = 'id';

    protected $fillable = [ 'nombre', 'estado', 'stockactual', 'stocklocal', 'origen', 'condiva', 'codproveedor', 'stockmin', 'stockmax', 'monedacompra', 'costopesos', 
                            'costodolar', 'costoeuro', 'pjegremio', 'pjeparticular', 'pjeespecial', 'pjeoferta', 'cantoferta', 'oferta', 'proveedor_id',
                            'categoria_id', 'familia_id', 'subfamilia_id' ];
    
    public function proveedor(){
    	return $this->belongsTo('App\Proveedor');
    }
    
    public function familia(){
    	return $this->belongsTo('App\Familia');
    }
    
    public function categoria(){
    	return $this->belongsTo('App\Categoria');
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
