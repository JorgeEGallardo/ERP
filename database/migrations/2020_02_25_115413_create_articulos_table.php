<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::dropIfExists('articulos');
        Schema::create('articulos', function (Blueprint $table) {
            $table->bigIncrements('id');//
            $table->string('Clave');//
            $table->string('ClaveAlterna')->nullable();//
            $table->string('Descripcion');//
            $table->BigInteger('id_linea')->unsigned();//
            $table->string('UnidadEntrada');//
            $table->string('UnidadSalida');//
            $table->double('Factor');//
            $table->double('Existencia');//
            $table->double('Minimo');//
            $table->double('Maximo');//
            $table->double('Esquema');
            $table->double('CostoPromedio');//
            $table->timestamp('FechaUltimaVenta')->nullable();
            $table->timestamp('FechaUltimaCompra')->nullable();
            $table->double('CostoUltimo');//
            $table->double('Volumen');//
            $table->double('Peso');//
            $table->double('Precio');//0
            $table->string('ClaveSat')->nullable();
            $table->string('ClaveUnidad')->nullable();
            $table->BigInteger('id_proveedor')->unsigned();
            $table->foreign('id_linea')->references('id')->on('lineas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_proveedor')->references('id')->on('proveedores')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('articulos');
    }
}
