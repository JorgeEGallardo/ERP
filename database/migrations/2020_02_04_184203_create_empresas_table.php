<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Nombre');
            $table->string('RFC');
            $table->string('RegistroPatronal');
            $table->string('Calle');
            $table->string('Numero');
            $table->string('Colonia');
            $table->string('Ciudad');
            $table->string('Estado');
            $table->string('Pais');
            $table->string('CP');
            $table->string('Email');
            $table->string('Telefono');
            $table->string('Telefono2')->nullable();

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
        Schema::dropIfExists('empresas');
    }
}
