<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Autorizaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autorizaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->BigInteger('id_departamento')->unsigned()->nullable();
            $table->BigInteger('id_usuario')->unsigned()->nullable();
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('set null')->onUpdate('Cascade');
            $table->foreign('id_departamento')->references('id')->on('departamentos')->onDelete('set null')->onUpdate('Cascade');
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
