<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subfamilia extends Model
{

    protected $table = 'subfamilias';

    protected $primaryKey = 'id';

    protected $fillable = ['nombre', 'proveedor_id'];

    public function proveedor()
	{
	    return $this->belongsTo('App\Proveedor','proveedor_id');
	}
    
    public function productos()
    {
    	return $this->hasMany('App\Producto');
    }
    
}
