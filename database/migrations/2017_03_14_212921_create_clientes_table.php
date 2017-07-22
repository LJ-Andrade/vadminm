<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function(Blueprint $table) {
            $table->increments('id');
            $table->string('razonsocial');
            $table->string('cuit');
            $table->string('dirfiscal');
            $table->string('codpostal');
            $table->string('telefono');
            $table->string('celular');
            $table->string('email');
            $table->string('descuento')->nullable();
            $table->integer('limitcred')->nullable();
            
            $table->integer('tipo_id')->unsigned()->nullable();
            $table->foreign('tipo_id')->references('id')->on('tipocts');
            $table->integer('iva_id')->unsigned();
            $table->foreign('iva_id')->references('id')->on('ivas');
            $table->integer('localidad_id')->unsigned()->nullable();
            $table->foreign('localidad_id')->references('id')->on('localidades');
            $table->integer('listas_id')->unsigned()->nullable();
            $table->foreign('listas_id')->references('id')->on('listas');
            $table->integer('zona_id')->unsigned()->nullable();
            $table->foreign('zona_id')->references('id')->on('zonas');
            $table->integer('provincia_id')->unsigned()->nullable();
            $table->foreign('provincia_id')->references('id')->on('provincias');
            $table->integer('condicventas_id')->unsigned()->nullable();
            $table->foreign('condicventas_id')->references('id')->on('condicventas');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('flete_id')->unsigned()->nullable();
            $table->foreign('flete_id')->references('id')->on('fletes');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('clientes');
    }
}
