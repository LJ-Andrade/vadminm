<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    
    protected $table = 'pagos';

    protected $primaryKey = 'id';

    protected $fillable = ['cliente_id', 'importe', 'modo', 'factura_nro', 'factura_id', 'bco_movimiento', 'ret_tipo', 'ret_jurisdiccion', 'ret_nro', 'ch_banco', 'ch_banco_nro', 'ch_sucursal', 'ch_fechacobro', 'ch_cuit', 'op'];
}
