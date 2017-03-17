<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{

    protected $table = 'zonas';

    protected $primaryKey = 'id';

    protected $fillable = ['name'];

    public function clientes()
    {
    	return $this->hasMany('App\Cliente');
    }

    
}
