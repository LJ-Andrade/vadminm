<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirentregasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direntregas', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('telefono');
            $table->integer('localidad_id')->unsigned();
            $table->integer('provincia_id')->unsigned();
            $table->integer('cliente_id')->unsigned();

            $table->foreign('localidad_id')->references('id')->on('localidades');
            $table->foreign('provincia_id')->references('id')->on('provincias');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            
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
        Schema::drop('direntregas');
    }
}
