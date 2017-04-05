<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{
    protected $table = 'familias';

    protected $primaryKey = 'id';

    protected $fillable = ['nombre', 'proveedor_id'];

    public function proveedor()
	{
	    return $this->belongsTo('App\Proveedor','proveedor_id');
	}
    
}
