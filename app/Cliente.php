<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{

    protected $table = 'clientes';

    protected $primaryKey = 'id';

    protected $fillable = ['id', 'razonsocial', 'cuit', 'dirfiscal', 'codpostal', 'limitcred', 'telefono', 'celular', 'email', 'tipo_id', 'descuento',
    'iva_id', 'provincia_id', 'localidad_id', 'condicventas_id', 'user_id', 'listas_id', 'zona_id', 'flete_id'];

    public function iva(){
    	return $this->belongsTo('App\Iva');
    }

    public function provincia(){
    	return $this->belongsTo('App\Provincia');
    }

    public function localidad(){
    	return $this->belongsTo('App\Localidade');
    }

    public function condicventas(){
    	return $this->belongsTo('App\Condicventa');
    }

    public function listas(){
    	return $this->belongsTo('App\Lista');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function zona(){
    	return $this->belongsTo('App\Zona');
    }

    public function flete(){
    	return $this->belongsTo('App\Flete');
    }

    // public function tipocts(){
    // 	return $this->belongsTo('App\Tipoct');
    // }

    public function tipoct(){
    	return $this->belongsTo('App\Tipoct', 'id');
    }

    public function direntregas(){
    	return $this->hasMany('App\Direntrega');
    }

    public function pedidos(){
    	return $this->hasMany('App\Pedido');
    }

    public function pedidositem(){
    	return $this->hasMany('App\Pedidositem');
    }

}
