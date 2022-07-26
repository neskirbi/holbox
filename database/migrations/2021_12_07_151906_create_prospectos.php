<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProspectos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prospectos', function (Blueprint $table) {
            $table->string('id',32)->unique();
            $table->string('id_creador',32);
            $table->string('id_atencion',32);
            $table->string('nombre',500);
            $table->string('correo',150);
            $table->string('telefono',150);
            $table->longtext('detalle');
            $table->integer('prioridad')->default(0);
            $table->integer('status')->default(0);
            $table->datetime('inicio')->useCurrent = true;
            $table->datetime('fin')->useCurrent = true;
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
        Schema::dropIfExists('prospectos');
    }
}
