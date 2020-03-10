<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Eventos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('eventos');
        Schema::create('eventos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Nombre');
            $table->string('Descripcion');
            $table->string('Inicio');
            $table->string('Fin');
            $table->BigInteger('id_usuario')->unsigned();
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
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
        //
    }
}
