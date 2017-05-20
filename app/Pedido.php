<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{

    protected $table = 'pedidos';

    protected $primaryKey = 'id';

    protected $fillable = ['cliente_id', 'estado', 'facturado', 'user_id'];

    public function pedidositems()
    {
		return $this->hasMany('App\Pedidositem');
	}

    public function cliente()
    {
    	return $this->belongsTo('App\Cliente');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    
}
