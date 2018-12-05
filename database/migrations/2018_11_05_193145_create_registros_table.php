<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('id_fraccionamiento');
            $table->integer('id_casa');
            $table->dateTime('entrada');
            $table->dateTime('salida');
            $table->string('tipo');
            $table->string('nombre');
            $table->string('foto_id');
            $table->string('foto_placas');
            $table->string('placas');
            $table->string('modelo');
            $table->string('color');
            $table->integer('id_autoriza');
            $table->integer('id_guardia');
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
        Schema::dropIfExists('registros');
    }
}
