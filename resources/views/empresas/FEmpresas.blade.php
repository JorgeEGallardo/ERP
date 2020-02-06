@extends('layouts.app')

@section('content')
<a href="/empresas"><button class="btn btn-danger ml-4" style="text-transform: none; width:10%"><i class="fas fa-arrow-circle-left"></i> Regresar </button></a>

<div class="container justify-content-center" style="max-width:none; width:100%; ">
    <h2 class="text-left white-text p-3" style="background-color:#2A1061; margin:0px">Crear nueva empresa</h2>
    <form class="text-left border border-light  z-depth-1 white" style="padding:0% 15% 0% 15%;" action="/empresas" method="POST">

        @csrf
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="p-5">
            <p class="h4 mb-4 "> Datos generales</p>

            <div class="form-row mb-4">
                <div class="col">
                    <!-- First name -->
                    <input type="text" id="NEmpresa" name="nombre" class="form-control" placeholder="Nombre de la empresa" value="{{ old('nombre') }}" required>
                </div>
                <div class="col">
                    <!-- Last name -->
                    <input type="text" id="RFC" name="rfc" class="form-control" value="{{ old('rfc') }}" placeholder="RFC" required>
                </div>
            </div>

            <input type="text" id="defaultRegisterFormEmail" name="registropatronal" value="{{ old('registropatronal') }}" class="form-control mb-4" placeholder="Registro patronal" required>

            <hr>
            <p class="h4 mb-4 ">Dirección</p>
            <input type="text" id="defaultRegisterFormEmail" name="calle" value="{{ old('calle') }}" class="form-control mb-4" placeholder="Calle" required>

            <div class="form-row mb-4">
                <div class="col-2">
                    <!-- First name -->
                    <input type="text" id="NEmpresa" name="numero" value="{{ old('numero') }}" class="form-control" placeholder="Número" required>
                </div>
                <div class="col">
                    <!-- Last name -->
                    <input type="text" id="RFC" name="colonia" value="{{ old('colonia') }}" class="form-control" placeholder="Colonia/Fraccionamiento" required>
                </div>
            </div>

            <div class="form-row mb-4">
                <div class="col">
                    <!-- First name -->
                    <select  id="countries" name="pais" onchange="getStates(this.value)" value="{{ old('pais') }}" class="form-control" placeholder="País" required>
                    @foreach($countries as $country)
                    <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="col" id="states">
                    <!-- Last name -->
                    <input type="text" name="estado" value="{{ old('estado') }}" class="form-control" placeholder="Estado" required>


                </div>
            </div>

            <div class="form-row mb-4">
                <div class="col" id="cities">
                    <!-- First name -->
                    <input type="text" id="NEmpresa" name="ciudad" value="{{ old('ciudad') }}" class="form-control" placeholder="Ciudad" required>

                </div>
                <div class="col-2">
                    <!-- Last name -->
                    <input type="text" id="RFC" name="CP" value="{{ old('CP') }}" class="form-control" placeholder="CP" required>
                </div>
            </div>
            <hr>

            <p class="h4 mb-4 ">Contacto</p>
            <input type="email" id="defaultRegisterFormEmail" value="{{ old('email') }}" name="email" class="form-control mb-4" placeholder="E-mail" required>

            <div class="form-row mb-4">
                <div class="col">
                    <!-- First name -->
                    <input type="text" id="NEmpresa" name="telefono" value="{{ old('telefono') }}" class="form-control" placeholder="Teléfono" required>
                </div>
                <div class="col">
                    <!-- Last name -->
                    <input type="text" id="RFC" name="telefono2" value="{{ old('telefono2') }}" class="form-control" placeholder="Teléfono adicional">
                </div>
            </div>

            <button class="btn btn-success" style="text-transform: none; width:100%"> Crear nueva empresa</button>
        </div>
    </form>

</div>
<script>
function getStates(id){
    $.ajax({
    url: '/getStates/'+id,
    type: 'GET',
    success: function(responseText){
        $('#states').html(responseText);
    },
    error: function(responseText){

    }
});
}
function getCities(id){
    $.ajax({
    url: '/getCities/'+id,
    type: 'GET',
    success: function(responseText){
        $('#cities').html(responseText);
    },
    error: function(responseText){

    }
});
}
</script>
@endsection
