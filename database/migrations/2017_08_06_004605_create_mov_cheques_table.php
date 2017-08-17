<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovChequesTable extends Migration
{

    public function up()
    {
        Schema::create('mov_cheques', function (Blueprint $table) {
            $table->increments('id');
            $table->string('banco')->nullable();
            $table->string('banco_nro')->nullable();
            $table->string('sucursal')->nullable();
            $table->string('fechacobro')->nullable();
            $table->integer('cuit')->nullable();
            $table->integer('movimiento_id')->unsigned();
            $table->foreign('movimiento_id')->references('id')->on('movimientos');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mov_cheques');
    }
}
