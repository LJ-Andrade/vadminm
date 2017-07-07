<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChequesTable extends Migration
{

    public function up()
    {
        Schema::create('cheques', function(Blueprint $table) {
            $table->increments('id');
            $table->string('cheque');
            $table->string('banco');
            $table->string('sucursal');
            $table->decimal('importe');
            $table->string('fechacobro');
            $table->integer('cuit');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::drop('cheques');
    }
}
