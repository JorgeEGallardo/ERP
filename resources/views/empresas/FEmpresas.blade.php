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
        <h2 class="text-left white-text m-1">Crear nueva empresa
            <a href="/empresas"><button class="btn btn-deep-purple float-right" style="margin:-0.3rem; text-transform:none; background-color:#3F729B!important"><b> <i class="far fa-eye mr-2"></i>Ver registros</b></button></a>
        </h2>
    </div>

    <form class="text-left border border-light  z-depth-1 white" style="padding:0% 15% 0% 15%;" action="/empresas" method="POST">
        @csrf
        <div class="p-5">
            <p class="h4 mb-4 "> Datos generales</p>

            <div class="form-row mb-4">
                <div class="col">
                    <input type="text" autofocus id="NEmpresa" name="nombre" class="form-control" placeholder="Nombre de la empresa" value="{{ old('nombre') }}" required>
                </div>
                <div class="col">
                    <input type="text" id="RFC" name="rfc" class="form-control" value="{{ old('rfc') }}" placeholder="RFC" required>
                </div>
            </div>

            <input type="text" id="defaultRegisterFormEmail" name="registropatronal" value="{{ old('registropatronal') }}" class="form-control mb-4" placeholder="Registro patronal" required>

            <hr>
            <p class="h4 mb-4 ">Dirección</p>
            <input type="text" id="defaultRegisterFormEmail" name="calle" value="{{ old('calle') }}" class="form-control mb-4" placeholder="Calle" required>

            <div class="form-row mb-4">
                <div class="col-2">
                    <input type="text" id="numero" name="numero" value="{{ old('numero') }}" class="form-control" placeholder="Número" required>
                </div>
                <div class="col">
                    <input type="text" id="RFC" name="colonia" value="{{ old('colonia') }}" class="form-control" placeholder="Colonia/Fraccionamiento" required>
                </div>
            </div>

            <div class="form-row mb-4">
                <div class="col">
                    <select id="countries" name="pais" onchange="getStates(this.value)" value="{{ old('pais') }}" class="form-control" placeholder="País" required>
                        @foreach($countries as $country)
                        <option value="{{$country->id}}">{{$country->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col" id="states">
                    <input type="text" name="estado" value="{{ old('estado') }}" class="form-control" placeholder="Estado" required>
                </div>
            </div>

            <div class="form-row mb-4">
                <div class="col" id="cities">
                    <input type="text" id="NCiudad" name="ciudad" value="{{ old('ciudad') }}" class="form-control" placeholder="Ciudad" required>
                </div>
                <div class="col-2">
                    <input type="text" id="RFC" name="CP" value="{{ old('CP') }}" class="form-control" placeholder="CP" required>
                </div>
            </div>
            <hr>

            <p class="h4 mb-4 ">Contacto</p>
            <input type="email" id="defaultRegisterFormEmail" value="{{ old('email') }}" name="email" class="form-control mb-4" placeholder="E-mail" required>
            <div class="form-row mb-4">
                <div class="col">
                    <input type="text" id="NTelefono" name="telefono" value="{{ old('telefono') }}" class="form-control" placeholder="Teléfono" required>
                </div>
                <div class="col">
                    <input type="text" id="RFC" name="telefono2" value="{{ old('telefono2') }}" class="form-control" placeholder="Teléfono adicional">
                </div>
            </div>
            <button class="btn btn-mdb-color py-3" style="text-transform: none; width:100%"> Crear nueva empresa</button>
        </div>
    </form>
</div>
</div>
<script>


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
    }
    function getCountries() {
    $.ajax({
        url: '/getCountries',
        type: 'GET',
        success: function(responseText) {
            $('#countries').html(responseText);
            getStates(1);
        },
        error: function(responseText) {

        }
    });
}
    $(document).ready(function() {
    getStates(1);
    getCities(2436);
    document.getElementById("NEmpresa").focus();
});
</script>
@endsection
