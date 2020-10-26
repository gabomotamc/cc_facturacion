<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('precios', function (Blueprint $table) {

            $table->uuid('uuid')->primary();
            $table->uuid('uuid_producto');
            $table->foreign('uuid_producto')->references('uuid')->on('productos');
            $table->double('precio_bruto_unitario', 15, 2);
            $table->double('precio_neto_unitario', 15, 2);            
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('precios');
    }
}
