<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovCheque extends Model
{
    protected $table = 'mov_cheques';

    protected $primaryKey = 'id';

    protected $fillable = ['tipo', 'jurisdiccion', 'nro', 'cliente_id', 'banco', 'banco_nro', 'sucursal', 'fechacobro', 'cuit'];

    public function movimiento()
    {
    	return $this->belongsTo('App\Movimiento');
    }

}
