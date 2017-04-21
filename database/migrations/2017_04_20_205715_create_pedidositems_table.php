<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePedidositemsTable extends Migration
{

    public function up()
    {
        Schema::create('pedidositems', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->integer('pedido_id')->unsigned();
            $table->foreign('pedido_id')->references('id')->on('pedidos');
            $table->integer('producto_id')->unsigned();
            $table->foreign('producto_id')->references('id')->on('productos');
            $table->integer('cantidad');
            $table->integer('valor');
            $table->timestamps();
        });

        Schema::create('pedido_pedidositem', function(Blueprint $table) {
            $table->increments('id'); 
            $table->integer('pedido_id');
            $table->integer('pedidositem_id');
            // $table->primary(['pedido_id', 'pedidositem_id']);
        });
    }

    public function down()
    {
        Schema::drop('pedidositems');
        Schema::drop('pedido_pedidositem');
    }
}
