<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flete extends Model
{

    protected $table = 'fletes';

    protected $primaryKey = 'id';

    protected $fillable = ['name'];

    public function clientes()
    {
    	return $this->hasMany('App\Cliente');
    }
    
}
