<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutorizacionesComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::dropIfExists('autorizaciones_compras');
        Schema::create('autorizaciones_compras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('LimiteInferior')->unsigned()->nullable();
            $table->bigInteger('LimiteSuperior')->unsigned()->nullable();
            $table->BigInteger('id_tipo_usuario')->unsigned()->nullable();
            $table->foreign('id_tipo_usuario')->references('ID')->on('tipos_usuarios');
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
        Schema::dropIfExists('autorizaciones_compras');
    }
}
