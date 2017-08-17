<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTiposComprobantesTable extends Migration
{

    public function up()
    {
        Schema::create('tiposcomprobantes', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('afipcode');
            $table->string('letter');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('tiposcomprobantes');
    }
}
