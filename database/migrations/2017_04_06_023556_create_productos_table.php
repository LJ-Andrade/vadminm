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
            $table->enum('estado', ['activo','pausado'])->default('activo');
            $table->string('codproveedor')->nullable();
            $table->float('condiva');
            $table->integer('stockactual');
            $table->integer('stockdeposito');
            $table->integer('stockmin');
            $table->integer('stockmax');
            $table->integer('origen');
            $table->integer('monedacompra');
            $table->integer('costopesos');
            $table->integer('costodolar');
            $table->integer('costoeuro');
            $table->float('pjegremio')->nullabble();
            $table->float('pjeparticular')->nullabble();
            $table->float('pjeespecial')->nullabble();
            $table->float('pjeoferta')->nullabble();
            $table->integer('cantoferta')->nullabble();
            $table->enum('oferta', ['on','off'])->default('off');

            $table->integer('moneda_id')->unsigned();
            $table->foreign('moneda_id')->references('id')->on('monedas');
            $table->integer('proveedor_id')->unsigned();
            $table->foreign('proveedor_id')->references('id')->on('proveedores');
            $table->integer('categoria_id')->unsigned();
            $table->foreign('categoria_id')->references('id')->on('categorias');
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
