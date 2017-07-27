<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flete extends Model
{

    protected $table = 'fletes';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'telefono', 'direccion', 'provincia_id', 'localidad_id'];

    public function clientes()
    {
    	return $this->hasMany('App\Cliente');
    }

    public function provincia(){
    	return $this->belongsTo('App\Provincia');
    }

    public function localidad(){
    	return $this->belongsTo('App\Localidad');
    }
    
}
