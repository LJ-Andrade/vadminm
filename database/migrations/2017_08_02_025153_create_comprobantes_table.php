<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComprobantesTable extends Migration
{

    public function up()
    {
        Schema::create('comprobantes', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('nro');
            $table->integer('cae');
            $table->string('vto');
            $table->string('pto_vta');
            $table->enum('letra', ['A','B']);
            $table->integer('afipcode');
            $table->decimal('subtotal');
            $table->decimal('iva');
            $table->decimal('total');

            $table->enum('estado', ['I','P'])->default('I');
            // I = Impago
            // P = Pago

            $table->enum('modo', ['F', 'ND', 'NC']);

            $table->enum('op', ['I', 'E'])->nullable();
            // I = Ingrego
            // E = Egreso
            $table->string('doc_filename');
            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->integer('flete_id')->unsigned();
            $table->foreign('flete_id')->references('id')->on('clientes');
            $table->integer('vendedor_id')->unsigned();
            $table->foreign('vendedor_id')->references('id')->on('users');
            $table->integer('direntrega_id')->unsigned();
            $table->foreign('direntrega_id')->references('id')->on('direntregas');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('comprobantes');
    }
}
