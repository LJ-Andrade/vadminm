<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipoct extends Model
{
    protected $table = 'tipocts';

    protected $primaryKey = 'id';

    protected $fillable = ['name'];

    public function clientes()
    {
    	return $this->hasMany('App\Cliente', 'tipo_id');
    }

}
