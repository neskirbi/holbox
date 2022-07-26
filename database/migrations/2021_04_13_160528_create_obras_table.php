<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obras', function (Blueprint $table) {

            $table->string('id',32)->unique();
            $table->string('id_generador',32);
            $table->string('id_planta',32);
            $table->string('obra',500);
            $table->string('tipoobra',150);
            $table->string('subtipoobra',150);            
            $table->float('cantidadobra',20,2);          
            $table->float('descuento',5,2)->default(0.0);
            $table->string('calle',500);
            $table->string('numeroext',10);
            $table->string('numeroint',10);
            $table->string('colonia',500);
            $table->string('municipio',150);
            $table->string('entidad',150);
            $table->string('cp',10);
            $table->string('latitud',50);
            $table->string('longitud',50);
            $table->string('fechainicio',30);
            $table->string('fechafin',30);

            $table->string('superficie',150)->default('');
            $table->string('superunidades',10)->default('');

            $table->boolean('aplicaplan');
            $table->string('nautorizacion',100)->default('');
            $table->string('vigenciaplan',30)->default('');
            $table->string('declaratoria',150)->default('');
            $table->string('planmanejo',150)->default('');

            $table->string('telefono',50);
            $table->string('celular',50);
            $table->string('correo',100);
            $table->string('correo2',100);
            $table->boolean('transporte')->default(0);
            $table->float('ivaobra',5,2)->default(0.0);
            $table->boolean('puedepospago')->default(0);
            $table->boolean('esalcaldia')->default(0);
            $table->float('limite',20,2);
            $table->string("contrato",40)->default('');            
            $table->boolean("verificado")->default(false);
            $table->boolean("terminada")->default(false);
            
            
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
        Schema::dropIfExists('obras');
    }
}
