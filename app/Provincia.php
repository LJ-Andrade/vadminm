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


}
