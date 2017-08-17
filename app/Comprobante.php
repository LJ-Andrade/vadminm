<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comprobante extends Model
{

    protected $table = 'comprobantes';

    protected $primaryKey = 'id';

    protected $fillable = ['nro', 'cae', 'vto', 'pto_vta', 'letra', 'afipcode', 'iva', 'subtotal', 'total', 'estado', 
                           'modo', 'op', 'doc_filename', 'cliente_id', 'flete_id', 'flete_id', 'vendedor_id', 'direntrega_id'];

    public function cliente(){
    	return $this->belongsTo('App\Cliente');
    }

    public function movimiento(){
    	return $this->belongsTo('App\Movimiento');
    }

}
