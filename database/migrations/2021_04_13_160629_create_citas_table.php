<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->string("id",32)->unique();
            $table->string("id_obra",32);
            $table->string("planta",150);
            $table->string("plantaauto",150);
            $table->string("direccionplanta",350);
            $table->datetime("fechacita");
            $table->string('nautorizacion',100);
            $table->string("razonsocial",150);

            //domicilio fiscal
            $table->string("calleynumerofis",150);
            $table->string("coloniafis",150);
            $table->string("municipiofis",150);
            $table->string("cpfis",150);

            //domicilio obra
            $table->string("obra",500);
            $table->string("calleynumeroobr",150);
            $table->string("coloniaobr",150);
            $table->string("municipioobr",150);
            $table->string("cpobr",150);
            $table->string("telefono",150);

            //datosresponsable
            $table->string("nombreres",150)->default('');
            $table->longtext("firmares")->default('');

            //Tipo de reciduo
            $table->string("id_materialobra",32);
            $table->string("material",150);
            $table->string("unidades",10);
            $table->float('precio',20,2);
            $table->float("cantidad",20,2);
            $table->float("iva",5,2);

            

            //veiculo
            
            $table->string("vehiculo",100);
            $table->string("marcaymodelo",100);
            $table->string("matricula",100)->default('');
            $table->string("ramir",100);
            $table->string("regsct",100);
            $table->string("razonvehiculo",150);
            $table->string("direccionvehiculo",500);
            $table->string("telefonovehiculo",150);

            //Chofer            
            $table->string("nombrecompleto",150)->default(''); 
            $table->longtext("firmachof")->default('');
            $table->string("combustible",100)->default('');
            //condiciones material
            $table->string("condicionesmaterial",100);

            //observaciones
            $table->string("observacion",500)->default('');


            //asistencia           
            $table->string("recibio",150)->default('');
            $table->longtext("firmarecibio")->default('');
            $table->string("cargo",150)->default('');
            $table->integer('folio')->default(0);

            $table->integer("confirmacion")->default(0);
            $table->integer("borrado")->default(1);
            
            $table->string("CodigoSAP",50)->default('');
            $table->datetime("ProcesadoSAP")->default(null);
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
        Schema::dropIfExists('citas');
    }
}
