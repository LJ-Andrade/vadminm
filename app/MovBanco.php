<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovBanco1 extends Model
{
    protected $table = 'mov_bancos';

    protected $primaryKey = 'id';

    protected $fillable = ['movimiento'];
    
    public function movimiento()
    {
    	return $this->belongsTo('App\Movimiento');
    }
}
