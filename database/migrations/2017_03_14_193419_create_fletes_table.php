<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFletesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fletes', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('telefono');
            $table->string('direccion');
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
        Schema::drop('fletes');
    }
}
