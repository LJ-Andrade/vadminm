<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubfamiliasTable extends Migration
{

    public function up()
    {
        Schema::create('subfamilias', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('familia_id')->unsigned();
            $table->foreign('familia_id')->references('id')->on('familias')->onDelete('restrict')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('subfamilias');
    }
}

