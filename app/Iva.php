<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Iva extends Model
{

    protected $table = 'ivas';

    protected $fillable = ['name', 'afipcode', 'tipofc'];

    protected $primaryKey = 'id';

    public function clientes()
    {
    	return $this->hasMany('App\Cliente');
    }

    public function proveedor()
	{
	    return $this->belongsTo('App\Proveedor','proveedor_id');
	}


}
