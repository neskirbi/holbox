<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantas', function (Blueprint $table) {
            $table->string('id',32)->unique();
            $table->string('planta',150);
            $table->string('siglas',20)->default('');
            $table->string('direccion',500);
            $table->string('codigo',500);
            $table->string('plantaauto',100);
            $table->integer('tipo',false,false)->default(1);

            $table->string('domingoi',10)->default('9:00');
            $table->string('lunesi',10)->default('9:00');
            $table->string('martesi',10)->default('9:00');
            $table->string('miercolesi',10)->default('9:00');
            $table->string('juevesi',10)->default('9:00');
            $table->string('viernesi',10)->default('9:00');
            $table->string('sabadoi',10)->default('9:00');

            $table->string('domingof',10)->default('18:00');
            $table->string('lunesf',10)->default('18:00');
            $table->string('martesf',10)->default('18:00');
            $table->string('miercolesf',10)->default('18:00');
            $table->string('juevesf',10)->default('18:00');
            $table->string('viernesf',10)->default('18:00');
            $table->string('sabadof',10)->default('18:00');
            
            
            $table->string('intervalo',20)->default('12');
            $table->boolean('activa')->default(true);
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
        Schema::dropIfExists('plantas');
    }
}
