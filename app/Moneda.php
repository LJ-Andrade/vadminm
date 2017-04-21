<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moneda extends Model
{
    protected $table = 'monedas';

    protected $primaryKey = 'id';

    protected $fillable = ['nombre', 'valor'];    

    public function productos()
    {
    	return $this->hasMany('App\Producto');
    }
}
