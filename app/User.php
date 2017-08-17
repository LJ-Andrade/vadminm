<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password','type', 'avatar', 'role', 'pto_vta'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeSearch($query, $name)
    {
    	return $query->where('name','=', $name);
    }

    public function clientes()
    {
    	return $this->hasMany('App\Cliente');
    }

    public function pedidos(){
    	return $this->hasMany('App\Pedido');
    }

}
