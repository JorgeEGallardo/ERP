@extends('layouts.app')

@section('content')
<div class="border m-3">


    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if (\Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif


    <div class="p-2 pt-3 indigo light-blue darken-4" style="width:100%;min-height:2rem">
        <h2 class="text-left white-text m-1">Editar proveedor
            <a href="/proveedores"><button class="btn btn-deep-purple float-right"
                    style="margin:-0.3rem; text-transform:none; background-color:#3F729B!important"><b> <i
                            class="far fa-eye mr-2"></i>Ver registros</b></button></a>
        </h2>
    </div>

    <form class="text-left border border-light  z-depth-1 white" style="padding:0% 15% 0% 15%;" action="/proveedores"
        method="POST">
        @csrf
        <div class="p-5">
            <div class="form-row mb-4">

                <div class="col-2">
                    <input type="text" class="form-control" name="clave" value="{{$proveedor->Clave}}" placeholder="Clave"
                        required>
                </div>

                <div class="col">
                    <input type="text" class="form-control" name="nombre" value="{{$proveedor->Nombre}}" required
                        placeholder="Nombre">
                </div>

            </div>
            <hr>

            <p class="h4 mb-4 "> Datos generales</p>

            <div class="form-row mb-4">
                <div class="col">
                    <input type="text" class="form-control" name="calle" value="{{$proveedor->Calle}}" placeholder="Calle"
                        required>
                </div>
            </div>



            <div class="form-row mb-4">

                <div class="col-2">
                    <input type="text" class="form-control" name="next" value="{{$proveedor->NExt}}"
                        placeholder="Núm. Ext">
                </div>

                <div class="col-2">
                    <input type="text" class="form-control" name="nInt" value="{{$proveedor->Nint}}"
                        placeholder="Núm. Int">
                </div>

                <div class="col">
                    <input type="text" class="form-control" name="ecalle" value="{{$proveedor->ECalle}}"
                        placeholder="Entre calle">
                </div>

            </div>


            <div class="form-row mb-4">
                <div class="col">
                    <input type="text" class="form-control" name="ecalle2" value="{{$proveedor->ECalle2}}"
                        placeholder="Y calle" >
                </div>

                <div class="col-3">
                    <input type="text" class="form-control" name="colonia" value="{{$proveedor->Colonia}}" required
                        placeholder="Colonia">
                </div>
                <div class="col-3">
                    <input type="text" class="form-control" name="CP" value="{{$proveedor->CP}}"
                        placeholder="Código postal">
                </div>
            </div>


            <div class="form-row mb-4">

                <div class="col">
                    <input type="text" class="form-control" name="pais" value="{{$proveedor->Pais}}" placeholder="País"
                        required>
                </div>

                <div class="col">
                    <input type="text" class="form-control" name="estado" value="{{$proveedor->Estado}}"
                        placeholder="Estado">
                </div>

            </div>


            <div class="form-row mb-4">

                <div class="col-4">
                    <input type="text" class="form-control" name="municipio" value="{{$proveedor->Municipio}}"
                        placeholder="Municipio" required>
                </div>

                <div class="col-4">
                    <input type="text" class="form-control" name="poblacion" value="{{$proveedor->Poblacion}}"
                        placeholder="Población">
                </div>

                <div class="col-4">
                    <input type="text" class="form-control" name="nacionalidad" value="{{$proveedor->Nacionalidad}}"
                        placeholder="Nacionalidad">
                </div>
            </div>


            <div class="form-row mb-4">
                <div class="col">
                    <input type="text" class="form-control" name="clasificacion" value="{{$proveedor->Clasificacion}}"
                        placeholder="Clasificación" required>
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="giro" value="{{$proveedor->Giro}}" placeholder="Giro" required>
                </div>
            </div>


            <div class="form-row mb-4">
                <div class="col">
                    <input type="text" class="form-control" name="rfc" value="{{$proveedor->RFC}}" placeholder="RFC"
                        required>
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="curp" value="{{$proveedor->CURP}}" placeholder="CURP">
                </div>
            </div>


            <hr>
            <p class="h4 mb-4 "> Saldo</p>
            <!-- DiasCredito	Saldo	Limite	Forma	Titular	Banco	Sucursal	Cuenta	Clabe---->
            <div class="form-row mb-4">
                <div class="col">
                    <input type="text" class="form-control" name="forma" value="{{$proveedor->Forma}}" placeholder="Forma"
                        required>
                </div>

            </div>
            <div class="form-row mb-4">
                <div class="col">
                    <input type="text" class="form-control" name="dias" value="{{$proveedor->DiasCredito}}"
                        placeholder="Días de crédito" required>
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="saldo" value="{{$proveedor->Saldo}}" placeholder="Saldo">
                </div>
            </div>

            <div class="form-row mb-4">
                <div class="col">
                    <input type="text" class="form-control" name="limite" value="{{$proveedor->Limite}}"
                        placeholder="Límite de saldo" >
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="titular" value="{{$proveedor->Titular}}"
                        placeholder="Titular">
                </div>
            </div>

            <div class="form-row mb-4">
                <div class="col">
                    <input type="text" class="form-control" name="banco" value="{{$proveedor->Banco}}" placeholder="Banco"
                        >
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="sucursal" value="{{$proveedor->Sucursal}}"
                        placeholder="Sucursal">
                </div>
            </div>

            <div class="form-row mb-4">
                <div class="col">
                    <input type="text" class="form-control" name="cuenta" value="{{$proveedor->Cuenta}}"
                        placeholder="Cuenta" >
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="clabe" value="{{$proveedor->Clabe}}" placeholder="Clabe">
                </div>
            </div>

            <hr>
            <p class="h4 mb-4 "> Contacto</p>
            <div class="form-row mb-4">
                <div class="col">
                    <input type="text" class="form-control" name="telefono" value="{{$proveedor->Telefono}}"
                        placeholder="Teléfono" >
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="fax" value="{{$proveedor->Fax}}" placeholder="Fax">
                </div>
            </div>

            <div class="form-row mb-4">
                <div class="col">
                    <input type="email" class="form-control" name="email" value="{{$proveedor->email}}"
                        placeholder="E-mail" >
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="web" value="{{$proveedor->Pagina}}"
                        placeholder="Página web">
                </div>
            </div>


            <hr>

            <button class="btn btn-mdb-color py-3" style="text-transform: none; width:100%"> Crear nuevo
                proveedor</button>
        </div>
    </form>
</div>
</div>
<script>
/*
    function getStates(id) {
        $.ajax({
            url: '/getStates/' + id,
            type: 'GET',
            success: function(responseText) {
                $('#states').html(responseText);
            },
            error: function(responseText) {

            }
        });
    }

    function getCities(id) {
        $.ajax({
            url: '/getCities/' + id,
            type: 'GET',
            success: function(responseText) {
                $('#cities').html(responseText);
            },
            error: function(responseText) {

            }
        });
    }*/
</script>
@endsection
