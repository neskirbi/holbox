<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurantes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurantes', function (Blueprint $table) {
            $table->string('id',32)->unique();

            $table->json('json');

            /*$table->string('cliente',500);
            $table->string('razonsocial',500);
            $table->string('telefono',500);
            $table->string('contactocomercial',500);
            $table->string('calle',500);
            $table->string('numeroext',500);
            $table->string('numeroint',500);
            $table->string('colonia',500);
            $table->string('municipio',500);
            $table->string('cp',500);
            $table->string('entidad',500);
            $table->string('giro',500);
            $table->string('ncomensales',500);
            $table->string('aforo',500);
            $table->string('superficie',500);
            $table->string('antiguedad',500);
            $table->string('afiliado',500);
            $table->string('franquicia',500);
            $table->string('categoria',500);
            $table->string('wifi',500);
            $table->string('areainfantil',500);
            $table->string('aireacon',500);
            $table->string('reservacion',500);
            $table->string('entrega',500);
            $table->string('llevar',500);
            $table->string('trampas',500);
            $table->string('clasificacion',500);
            $table->string('rangoprecio',500);
            $table->string('reciclaje',500);
            $table->string('tresiduo',500);
            $table->string('bolsas',500);
            $table->string('pagos',500);
            $table->string('contrata',500);
            $table->string('horarios',500);
            $table->string('donde',500);
            $table->string('tratamiento',500);
            $table->string('correo',500);
            $table->string('facebook',500);
            $table->string('instagram',500);
            $table->string('twitter',500);
            $table->string('youtube',500);
            $table->string('tiktok',500);
            $table->string('ventas',500);
            $table->string('cerrar',500);
            $table->string('razon',500);*/
            
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
        Schema::dropIfExists('restaurantes');
    }
}
