<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialesObra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materialesobra', function (Blueprint $table) {
            $table->string('id',32)->unique();
            $table->string('id_obra',32);
            $table->string('categoriamaterial',150);
            $table->string('id_material',32);
            $table->string('material',150);
            $table->float('cantidad',20,2);
            $table->float('precio',20,2);
            $table->string('unidades',10);
            $table->unique(['id_obra', 'id_material']);
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
        Schema::dropIfExists('materialesobra');
    }
}
