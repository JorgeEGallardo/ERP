<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('proveedores');
        Schema::dropIfExists('contactos');
        Schema::create('contactos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Nombre');
            $table->string('Celular');
            $table->string('Email');
        });
        Schema::create('proveedores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Nombre');
            $table->string('Clave');
            $table->string('Calle');
            $table->string('NExt')->nullable();
            $table->string('Nint')->nullable();
            $table->string('ECalle')->nullable();
            $table->string('ECalle2')->nullable();
            $table->string('Colonia');
            $table->string('CP')->default('0');
            $table->string('Pais')->default('Mexico');
            $table->string('Estado')->default('Durango');
            $table->string('Municipio')->default('Dgo');
            $table->string('Poblacion')->default('Victoria de Durango');
            $table->string('Nacionalidad')->nullable();
            $table->string('Clasificacion');
            $table->string('Giro');
            $table->string('RFC');
            $table->string('CURP')->nullable();
            $table->string('Telefono');
            $table->string('Fax')->nullable();
            $table->string('email');
            $table->string('Pagina')->nullable();
            $table->integer('DiasCredito')->default('0');
            $table->double('Saldo')->default('0');
            $table->double('Limite')->default('0');
            $table->integer('Forma')->default('0');
            $table->string('Titular');
            $table->string('Banco')->nullable();
            $table->string('Sucursal')->nullable();
            $table->string('Cuenta');
            $table->string('Clabe');
            $table->BigInteger('id_contacto')->unsigned()->nullable();
            $table->foreign('id_contacto')->references('id')->on('contactos')->onDelete('set null');
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
        Schema::dropIfExists('proveedores');
    }
}
