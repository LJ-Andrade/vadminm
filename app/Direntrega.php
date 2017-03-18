<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Direntrega extends Model
{

    protected $table = 'direntregas';

    protected $primaryKey = 'id';

    protected $fillable = ['cliente', 'name', 'provincia', 'localidad', 'telefono', 'cliente_id'];

    public function provincia()
    {
    	return $this->belongsTo('App\Provincia');
    }

    public function clientes()
    {
    	return $this->belongsTo('App\Cliente');
    }
    
}
