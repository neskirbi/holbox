<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransporteobras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transporteobras', function (Blueprint $table) {
            $table->string('id',32)->unique();
            $table->string('id_obra',32);
            $table->string('id_transporte',32);
            $table->string('transporte',150);
            $table->string('descripcion',300);
            $table->float('capacidad',20,2); 
            $table->integer('cantidad')->defautl(0);   
            $table->float('precio',20,2);  
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
        Schema::dropIfExists('transporteobras');
    }
}
