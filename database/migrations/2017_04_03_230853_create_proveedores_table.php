<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('razonsocial');
            $table->string('cuit');
            $table->string('ingbrutos');
            $table->string('telefonos');
            $table->string('email');
            $table->string('direccion')->nullable();
            $table->string('pais');
            $table->string('codpostal');
            $table->text('notas');

            $table->integer('iva_id')->unsigned();
            $table->foreign('iva_id')->references('id')->on('ivas');
            $table->integer('localidad_id')->unsigned()->nullable();
            $table->foreign('localidad_id')->references('id')->on('localidades');
            $table->integer('provincia_id')->unsigned()->nullable();
            $table->foreign('provincia_id')->references('id')->on('provincias');

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
        Schema::drop('proveedores');
    }
}
