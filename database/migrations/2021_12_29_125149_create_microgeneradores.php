<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMicrogeneradores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('microgeneradores', function (Blueprint $table) {
            $table->string("id",32)->unique(); 
            $table->string('nombre',150);            
            $table->string('telefono',40);
            $table->string('correo',150);            
            $table->string('calle',500);
            $table->string('numeroext',50);
            $table->string('numeroint',50);
            $table->string('colonia',500);
            $table->string('municipio',50);
            $table->string('cp',20);
            $table->string("material",255);
            $table->float("cantidad",20,2);
            $table->float("precio",20,2);
            $table->float("iva",20,2);
            $table->string("condicionmaterial",100);
            $table->string('fechayhora',50);
            $table->integer("confirmacion")->default(0);
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
        Schema::dropIfExists('microgeneradores');
    }
}
