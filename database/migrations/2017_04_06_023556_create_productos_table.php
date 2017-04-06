<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('unidad');
            $table->enum('estado', ['activo','pausado'])->default('activo');
            $table->integer('stockactual');
            $table->integer('stockmin');
            $table->integer('stockmax');
            $table->integer('preciocompra');
            $table->integer('preciocosto');
            $table->integer('preciogremio');
            $table->integer('precioparticular');
            $table->integer('precioespecial');
            $table->integer('preciooferta');

            $table->integer('proveedor_id')->unsigned();
            $table->foreign('proveedor_id')->references('id')->on('proveedores');
            $table->integer('familia_id')->unsigned();
            $table->foreign('familia_id')->references('id')->on('familias');
            $table->integer('subfamilia_id')->unsigned();
            $table->foreign('subfamilia_id')->references('id')->on('subfamilias');

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
        Schema::drop('productos');
    }
}
