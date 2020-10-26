<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {

            $table->uuid('uuid')->primary();

            $table->uuid('uuid_producto');
            $table->foreign('uuid_producto')->references('uuid')->on('productos');

            $table->uuid('uuid_factura');
            $table->foreign('uuid_factura')->references('uuid')->on('facturas'); 
                       
            $table->integer('cantidad')->unsigned();
            $table->double('subtotal', 15, 2);
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
        Schema::dropIfExists('items');
    }
}
