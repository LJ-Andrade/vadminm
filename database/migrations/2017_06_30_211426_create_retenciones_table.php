<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRetencionesTable extends Migration
{
    
    public function up()
    {
        Schema::create('retenciones', function(Blueprint $table) {
            $table->increments('id');
            $table->string('tipo');
            $table->string('jurisdiccion');
            $table->string('nocomprobante');
            $table->decimal('importe', 5, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('retenciones');
    }
}
