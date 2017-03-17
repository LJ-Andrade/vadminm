<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{

    protected $table = 'listas';

    protected $primaryKey = 'id';

    protected $fillable = ['name'];

    public function clientes()
    {
    	return $this->hasMany('App\Cliente');
    }

    
}
