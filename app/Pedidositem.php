<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedidositem extends Model
{

    protected $table = 'pedidositems';

    protected $primaryKey = 'id';

    protected $fillable = ['cliente_id', 'pedido_id', 'producto_id', 'cantidad', 'valor'];

    public function pedidos()
    {
		return $this->hasToMany('App\Pedido');
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
