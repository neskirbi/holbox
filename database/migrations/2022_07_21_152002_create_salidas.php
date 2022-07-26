<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalidas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salidas', function (Blueprint $table) {
            $table->string('id',32)->unique();
            $table->string('id_planta',32);
            $table->string('id_destino',32);
            $table->string('id_administrador',32)->default('');
            $table->string("nombreres",150)->default('');
            $table->longtext("firmares")->default('');
            
            //chofer
            $table->longtext("nombrechofer")->default('');
            $table->string("vehiculo",100);
            $table->string("marcaymodelo",100);
            $table->string("matricula",100)->default('');            
            $table->longtext("firmachof")->default('');

            //observaciones
            $table->string("observacion",500)->default('');

            //Tipo de reciduo
            $table->string("id_material",32);
            $table->string("material",150);
            $table->string("unidades",10);
            $table->float('precio',20,2);
            $table->float("cantidad",20,2);

            $table->string("recibio",150)->default('');
            $table->longtext("firmarecibio")->default('');
            $table->string("cargo",150)->default('');

            
            $table->datetime("fechasalida");
            
            $table->datetime("fechaentrada");

            //asistencia           
            $table->int("confirmacion",1)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salidas');
    }
}
