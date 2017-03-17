<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Localidade extends Model
{

    protected $table = 'localidades';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'province_id'];

    public function clientes()
    {
    	return $this->hasMany('App\Cliente');
    }
    
}
