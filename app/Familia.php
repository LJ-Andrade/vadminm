<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{
    protected $table = 'familias';

    protected $primaryKey = 'id';

    protected $fillable = ['nombre', 'categoria_id'];

    // public function proveedor()
	// {
	//     return $this->belongsTo('App\Proveedor','proveedor_id');
	// }

    public function categoria()
	{
	    return $this->belongsTo('App\Categoria','categoria_id');
	}

    public function productos()
    {
    	return $this->hasMany('App\Producto');
    }
    
}
