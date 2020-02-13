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
        <h2 class="text-left white-text m-1">Crear nuevo proveedor
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
                    <input type="text" class="form-control" name="clave" value="{{ old('clave') }}" placeholder="Clave"
                        required>
                </div>

                <div class="col">
                    <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" required
                        placeholder="Nombre">
                </div>

            </div>
            <hr>

            <p class="h4 mb-4 "> Datos generales</p>

            <div class="form-row mb-4">
                <div class="col">
                    <input type="text" class="form-control" name="calle" value="{{ old('calle') }}" placeholder="Calle"
                        required>
                </div>
            </div>



            <div class="form-row mb-4">

                <div class="col-2">
                    <input type="text" class="form-control" name="next" value="{{ old('next') }}"
                        placeholder="Núm. Ext">
                </div>

                <div class="col-2">
                    <input type="text" class="form-control" name="nInt" value="{{ old('nint') }}"
                        placeholder="Núm. Int">
                </div>

                <div class="col">
                    <input type="text" class="form-control" name="ecalle" value="{{ old('ecalle') }}"
                        placeholder="Entre calle">
                </div>

            </div>


            <div class="form-row mb-4">
                <div class="col">
                    <input type="text" class="form-control" name="ecalle2" value="{{ old('ecalle2') }}"
                        placeholder="Y calle" required>
                </div>

                <div class="col-3">
                    <input type="text" class="form-control" name="colonia" value="{{ old('colonia') }}" required
                        placeholder="Colonia">
                </div>
                <div class="col-3">
                    <input type="text" class="form-control" name="CP" value="{{ old('CP') }}"
                        placeholder="Código postal">
                </div>
            </div>


            <div class="form-row mb-4">

                <div class="col">
                    <input type="text" class="form-control" name="pais" value="{{ old('pais') }}" placeholder="País"
                        required>
                </div>

                <div class="col">
                    <input type="text" class="form-control" name="estado" value="{{ old('estado') }}"
                        placeholder="Estado">
                </div>

            </div>


            <div class="form-row mb-4">

                <div class="col-4">
                    <input type="text" class="form-control" name="municipio" value="{{ old('municipio') }}"
                        placeholder="Municipio" required>
                </div>

                <div class="col-4">
                    <input type="text" class="form-control" name="poblacion" value="{{ old('poblacion') }}"
                        placeholder="Población">
                </div>

                <div class="col-4">
                    <input type="text" class="form-control" name="nacionalidad" value="{{ old('nacionalidad') }}"
                        placeholder="Nacionalidad">
                </div>
            </div>


            <div class="form-row mb-4">
                <div class="col">
                    <input type="text" class="form-control" name="clasificacion" value="{{ old('clasificacion') }}"
                        placeholder="Clasificación" required>
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="giro" value="{{ old('giro') }}" placeholder="Giro">
                </div>
            </div>


            <div class="form-row mb-4">
                <div class="col">
                    <input type="text" class="form-control" name="rfc" value="{{ old('rfc') }}" placeholder="RFC"
                        required>
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="curp" value="{{ old('curp') }}" placeholder="CURP">
                </div>
            </div>


            <hr>
            <p class="h4 mb-4 "> Saldo</p>
            <!-- DiasCredito	Saldo	Limite	Forma	Titular	Banco	Sucursal	Cuenta	Clabe---->
            <div class="form-row mb-4">
                <div class="col">
                    <input type="text" class="form-control" name="forma" value="{{ old('forma') }}" placeholder="Forma"
                        required>
                </div>

            </div>
            <div class="form-row mb-4">
                <div class="col">
                    <input type="text" class="form-control" name="dias" value="{{ old('dias') }}"
                        placeholder="Días de crédito" required>
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="saldo" value="{{ old('saldo') }}" placeholder="Saldo">
                </div>
            </div>

            <div class="form-row mb-4">
                <div class="col">
                    <input type="text" class="form-control" name="limite" value="{{ old('limite') }}"
                        placeholder="Límite de saldo" required>
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="titular" value="{{ old('titular') }}"
                        placeholder="Titular">
                </div>
            </div>

            <div class="form-row mb-4">
                <div class="col">
                    <input type="text" class="form-control" name="banco" value="{{ old('banco') }}" placeholder="Banco"
                        required>
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="sucursal" value="{{ old('sucursal') }}"
                        placeholder="Sucursal">
                </div>
            </div>

            <div class="form-row mb-4">
                <div class="col">
                    <input type="text" class="form-control" name="cuenta" value="{{ old('cuenta') }}"
                        placeholder="Cuenta" required>
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="clabe" value="{{ old('clabe') }}" placeholder="Clabe">
                </div>
            </div>

            <hr>
            <p class="h4 mb-4 "> Contacto</p>
            <div class="form-row mb-4">
                <div class="col">
                    <input type="text" class="form-control" name="telefono" value="{{ old('telefono') }}"
                        placeholder="Teléfono" required>
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="fax" value="{{ old('fax') }}" placeholder="Fax">
                </div>
            </div>

            <div class="form-row mb-4">
                <div class="col">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                        placeholder="E-mail" required>
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="web" value="{{ old('web') }}"
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
