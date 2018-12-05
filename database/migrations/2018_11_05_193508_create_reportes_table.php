*<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportes', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('id_fraccionamiento');
            $table->string('descripcion');
            $table->integer('id_casa');
            $table->string('prioridad')->default('Baja');
            $table->string('estatus')->default('Pendiente');
            $table->string('foto');
            $table->string('activo')->default('si');
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
        Schema::dropIfExists('reportes');
    }
}
