<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{

    protected $table = 'provincias';

    protected $primaryKey = 'id';

    protected $fillable = ['name'];

    public function clientes()
    {
    	return $this->hasMany('App\Cliente');
    }

    public function fletes()
    {
    	return $this->hasMany('App\Flete');
    }
    
    public function direntregas()
    {
    	return $this->hasMany('App\Direntrega');
    }

    public function localidades()
    {
    	return $this->hasMany('App\Localidad');
    }

}
