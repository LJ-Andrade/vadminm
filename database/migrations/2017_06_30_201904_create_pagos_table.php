<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagosTable extends Migration
{
    
    public function up()
    {
        // Pagos
        // 1 = Efectivo
        // 2 = Cheques
        // 3 = Banco
        // 4 = Retenciones

        Schema::create('pagos', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id');
            $table->decimal('importe', 5, 2);
            $table->enum('modo', [1,2,3,4])->default(1);
            $table->string('factura');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::drop('pagos');
    }
}
