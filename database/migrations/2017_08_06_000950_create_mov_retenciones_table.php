<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovRetencionesTable extends Migration
{

    public function up()
    {
        Schema::create('mov_retenciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo')->nullable();
            $table->string('jurisdiccion')->nullable();
            $table->string('nro')->nullable();
            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->integer('movimiento_id')->unsigned();
            $table->foreign('movimiento_id')->references('id')->on('movimientos');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mov_retenciones');
    }
}
