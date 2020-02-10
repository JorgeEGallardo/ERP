<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Series extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('series');
        Schema::create('series', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Nombre')->unique();
            $table->BigInteger('id_tipo')->unsigned()->nullable();
            $table->BigInteger('id_usuario')->unsigned()->nullable();
            $table->foreign('id_tipo')->references('id')->on('tipos_series')->onDelete('set null');
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('set null');
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
        Schema::dropIfExists('series');
    }
}
