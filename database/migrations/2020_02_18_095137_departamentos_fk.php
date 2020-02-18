<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DepartamentosFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('departamentos');
        Schema::dropIfExists('ubicaciones');
        Schema::create('ubicaciones', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->string('Nombre')->unique();
            $table->timestamps();
        });
        Schema::create('departamentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Nombre');
            $table->BigInteger('Ubicacion')->unsigned()->nullable();
            $table->foreign('Ubicacion')->references('ID')->on('ubicaciones')->onDelete('set null')->onUpdate('Cascade');
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
        Schema::dropIfExists('departamentos');
    }
}
