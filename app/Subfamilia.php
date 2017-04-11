<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subfamilia extends Model
{

    protected $table = 'subfamilias';

    protected $primaryKey = 'id';

    protected $fillable = ['nombre', 'familia_id'];

    public function familia()
	{
	    return $this->belongsTo('App\Familia');
	}
    
    public function productos()
    {
    	return $this->hasMany('App\Producto');
    }
    
}
