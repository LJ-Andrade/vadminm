<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reparacion extends Model
{
    protected $table = 'reparaciones';

    protected $primaryKey = 'id';

    protected $fillable = ['cliente_id', 'estado', 'facturado', 'user_id'];

    public function reparacionesitems()
    {
		return $this->hasMany('App\Reparacionesitem');
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
