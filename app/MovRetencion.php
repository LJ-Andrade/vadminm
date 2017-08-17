<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovRetencion extends Model
{
    protected $table = 'mov_retenciones';

    protected $primaryKey = 'id';

    protected $fillable = ['tipo', 'jurisdiccion', 'nro', 'cliente_id'];

    public function movimiento()
    {
    	return $this->belongsTo('App\Movimiento');
    }

}
