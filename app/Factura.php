<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{

    protected $table = 'facturas';

    protected $primaryKey = 'id';

    protected $fillable = ['numero', 'tipo_fc_id', 'tipo_fc', 'cae', 'centroemisor', 'estado', 'iva', 'subtotal','total', 'direntrega_id', 'flete_id', 'vendedor_id', 'cliente_id'];

    public function cliente(){
    	return $this->belongsTo('App\Cliente');
    }
    
}
