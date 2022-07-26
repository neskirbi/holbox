<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->string('id',32)->unique();
            $table->string('id_planta',32); 
            $table->string('id_usuario',32);             
            $table->string('id_obra',32); 
            $table->string('obra',150); 
            $table->string('direccion',1500);
            $table->string('latitud',50);
            $table->string('longitud',50);
            $table->string('telefono',50);
            $table->string('correo',100); 
            
            $table->string('instrucciones',500)->default('');           
            $table->string('comentario',500)->default(''); 
            $table->datetime('fechaentrega'); 


            $table->float('subtotal',20,2);
            $table->float('iva',20,2);
            $table->float('total',20,2);

            $table->boolean('confirmacion',1)->default(1);         
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
        Schema::dropIfExists('pedidos');
    }
}
