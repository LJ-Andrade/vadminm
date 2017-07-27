<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{

    protected $table = 'localidades';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'province_id'];

    public function clientes()
    {
    	return $this->hasMany('App\Cliente');
    }

    public function fletes()
    {
    	return $this->hasMany('App\Flete');
    }

    public function provincia()
    {
    	return $this->belongsTo('App\Provincia', 'province_id');
    }
    
}
