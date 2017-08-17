<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovBancosTable extends Migration
{
    public function up()
    {
        Schema::create('mov_bancos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('movimiento')->nullable();
            $table->integer('movimiento_id')->unsigned();
            $table->foreign('movimiento_id')->references('id')->on('movimientos');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mov_bancos');
    }
}
