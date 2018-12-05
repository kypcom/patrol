<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('id_fraccionamiento');
            $table->string('id_casa');
            $table->string('evento');
            $table->string('estatus')->default('Activo');
            $table->integer('id_autoriza');
            $table->string('fecha_inicial');
            $table->string('fecha_final');
            $table->string('hora_inicial');
            $table->string('hora_final');
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
        Schema::dropIfExists('eventos');
    }
}
