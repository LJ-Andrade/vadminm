<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Condicventa extends Model
{

    protected $table = 'condicventas';

    protected $primaryKey = 'id';

    protected $fillable = ['name'];

    public function clientes()
    {
    	return $this->hasMany('App\Cliente');
    }
    
}
