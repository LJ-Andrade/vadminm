<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMovimientosTable extends Migration
{

    public function up()
    {
        Schema::create('movimientos', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente_id');
            $table->decimal('importe', 5, 2);
            $table->string('det1')->nullable();
            $table->string('det2')->nullable();
            $table->string('det3')->nullable();
            $table->string('det4')->nullable();
            $table->string('det5')->nullable();
            
            $table->enum('modo', ['F', 'NC', 'ND', 'E', 'B', 'C', 'R'])->nullable();
            // F = Factura, NC = Nota de Crédito, ND = Nota de Débito
            // P = Pago
            
            $table->enum('op', ['I', 'E'])->nullable();
            // I = Ingrego
            // E = Egreso
            
            $table->enum('estado', ['P', 'I'])->nullable()->default('I');
            // P = Pago
            // I = Impago
            
            $table->string('comprobante_nro')->nullable();
            $table->integer('comprobante_id')->nullable();
            $table->string('saldo');
            $table->string('subtotal');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('movimientos');
    }
}
