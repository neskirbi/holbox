<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosobras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productosobras', function (Blueprint $table) {
            $table->string('id',32)->unique();
            $table->string('id_obra',32); 
            $table->string('id_producto',32);
            $table->string('categoria',150);                      
            $table->string('producto',150);                      
            $table->string('unidades',10);
            $table->string('descripcion',300);
            $table->float('precio',20,2);     
            $table->boolean('transporte')->default(0); 
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
        Schema::dropIfExists('productosobras');
    }
}
