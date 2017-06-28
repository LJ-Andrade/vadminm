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
            $table->enum('tipo_fc', ['A','B']);
            $table->integer('tipo_fc_id');
            $table->integer('cae');
            $table->enum('estado', ['0','1'])->default('0');
            $table->string('centroemisor');
            $table->string('direntrega_id');
            $table->decimal('iva');
            $table->decimal('subtotal');
            $table->decimal('total');
            $table->string('flete_id');
            $table->string('vendedor_id');

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
