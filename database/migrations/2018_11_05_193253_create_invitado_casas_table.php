<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvitadoCasasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitado_casas', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('id_fraccionamiento');
            $table->integer('id_casa');
            $table->string('invitado');
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
        Schema::dropIfExists('invitado_casas');
    }
}
