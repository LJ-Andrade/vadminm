<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagosTable extends Migration
{
    
    public function up()
    {
        // Pagos
        // E = Efectivo
        // C = Cheques
        // B = Banco
        // R = Retenciones

        Schema::create('pagos', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente_id');
            $table->decimal('importe', 5, 2);
            $table->enum('modo', ['E','C','B','R'])->nullable();
            $table->string('factura_nro')->nullable();
            $table->integer('factura_id')->nullable();
            // Banco
            $table->string('bco_movimiento')->nullable();

            // Retencion
            $table->string('ret_tipo')->nullable();
            $table->string('ret_jurisdiccion')->nullable();
            $table->string('ret_nro')->nullable();
            
            // Cheque
            $table->string('ch_banco')->nullable();
            $table->string('ch_banco_nro')->nullable();
            $table->string('ch_sucursal')->nullable();
            $table->string('ch_fechacobro')->nullable();
            $table->integer('ch_cuit')->nullable();

            $table->string('op')->defaul('P');


            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::drop('pagos');
    }
}
