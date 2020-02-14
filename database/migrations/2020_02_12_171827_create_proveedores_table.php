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
            $table->string('Calle')->nullable();
            $table->string('NExt')->nullable();
            $table->string('Nint')->nullable();
            $table->string('ECalle')->nullable();
            $table->string('ECalle2')->nullable();
            $table->string('Colonia')->nullable();
            $table->string('CP')->nullable();
            $table->string('Pais')->nullable();
            $table->string('Estado')->nullable();
            $table->string('Municipio')->nullable();
            $table->string('Poblacion')->nullable();
            $table->string('Nacionalidad')->nullable();
            $table->string('Clasificacion');
            $table->string('Giro');
            $table->string('RFC');
            $table->string('CURP')->nullable();
            $table->string('Telefono')->nullable();
            $table->string('Fax')->nullable();
            $table->string('email')->nullable();
            $table->string('Pagina')->nullable();
            $table->integer('DiasCredito')->default('0');
            $table->double('Saldo')->nullable();
            $table->double('Limite')->nullable();
            $table->integer('Forma')->nullable();
            $table->string('Titular')->nullable();
            $table->string('Banco')->nullable();
            $table->string('Sucursal')->nullable();
            $table->string('Cuenta')->nullable();
            $table->string('Clabe')->nullable();
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
