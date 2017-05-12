<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFacturasTable extends Migration
{

    public function up()
    {
        Schema::create('facturas', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('numero');
            $table->string('tipo');
            $table->string('centroemisor');
            $table->string('direntrega');
            $table->string('flete');
            $table->string('vendedor');

            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('facturas');
    }
}
