<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campamentos', function (Blueprint $table) {
            $table->string('id',32)->unique();
            $table->string('arearesponsable',150);
            $table->string('calle',150);
            $table->string('colonia',150);
            $table->string('alcaldia',150);
            $table->string('codigopostal',50);
            $table->string('telefono',50);
            $table->string('nombreresponsablecamp',150);
                     
           
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
        Schema::dropIfExists('campamentos');
    }
}
