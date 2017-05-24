<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reparacionesitem extends Model
{

    protected $table = 'reparaciones_items';

    protected $primaryKey = 'id';

    protected $fillable = ['cliente_id', 'reparacion_id', 'producto_id', 'cantidad', 'valor'];

    public function reparaciones()
    {
		return $this->hasMany('App\Reparacion');
	}

    public function cliente()
    {
    	return $this->belongsTo('App\Cliente');
    }

     public function producto()
    {
    	return $this->belongsTo('App\Producto');
    }

}
