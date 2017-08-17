<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TiposComprobante extends Model
{

    protected $table = 'tiposcomprobantes';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'afipcode', 'letter'];
    
}
