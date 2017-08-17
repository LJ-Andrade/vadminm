<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFamiliasTable extends Migration
{

    public function up()
    {
        Schema::create('familias', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            // $table->integer('proveedor_id')->unsigned();
            // $table->foreign('proveedor_id')->references('id')->on('proveedores');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('familias');
    }
}
