<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $table = 'movimientos';

    protected $primaryKey = 'id';

    protected $fillable = ['cliente_id', 'importe', 'det1', 'det2', 'det3', 'det4', 'det5', 'modo', 'op', 'estado', 'comprobante_nro', 'comprobante_id', 'saldo', 'subtotal'];
            
    public function comprobantes()
    {
    	return $this->hasMany('App\Comprobante');
    }
    
    // modo
    // F = Factura, NC = Nota de Crédito, ND = Nota de Débito
    // P = Pago
    
    // op
    // I = Ingrego
    // E = Egreso
    
    // estado
    // P = Pago
    // I = Impago

}
