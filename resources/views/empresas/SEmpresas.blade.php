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
        <h2 class="text-left white-text m-1">Información sobre <b>{{$empresa->Nombre}}</b>
            <a href="/empresas"><button class="btn btn-deep-purple float-right"
                    style="margin:-0.3rem; text-transform:none; background-color:#3F729B!important"><b> <i
                            class="far fa-eye mr-2"></i>Ver registros</b></button></a>
    </div>
    <form class="text-left border border-light  z-depth-1 white" style="padding:0% 15% 0% 15%;"
        action="{{ route('empresas.update', $empresa->id) }}" method="POST">
        @method('PUT')

        @csrf

        <div class="p-5">
            <p class="h4 mb-4 "> Datos generales</p>

            <div class="form-row mb-4">
                <div class="col">
                    <!-- First name -->
                    <input type="text" id="NEmpresa" name="nombre" class="form-control"
                        placeholder="Nombre de la empresa" value="{{ $empresa->Nombre }}" required>
                </div>
                <div class="col">
                    <!-- Last name -->
                    <input type="text" id="RFC" name="rfc" class="form-control" value="{{ $empresa->RFC }}"
                        placeholder="RFC" required>
                </div>
            </div>

            <input type="text" id="defaultRegisterFormEmail" name="registropatronal"
                value="{{ $empresa->RegistroPatronal }}" class="form-control mb-4" placeholder="Registro patronal"
                required>

            <hr>
            <p class="h4 mb-4 ">Dirección</p>
            <input type="text" id="defaultRegisterFormEmail" name="calle" value="{{ $empresa->Calle }}"
                class="form-control mb-4" placeholder="Calle" required>

            <div class="form-row mb-4">
                <div class="col-2">
                    <!-- First name -->
                    <input type="text" id="NEmpresa" name="numero" value="{{ $empresa->Numero }}" class="form-control"
                        placeholder="Número" required>
                </div>
                <div class="col">
                    <!-- Last name -->
                    <input type="text" id="RFC" name="colonia" value="{{ $empresa->Colonia }}" class="form-control"
                        placeholder="Colonia/Fraccionamiento" required>
                </div>
            </div>

            <div class="form-row mb-4">
                <div class="col" id="countries">
                    <input type="text" name="pais" onclick="getCountries()" value="{{ $empresa->Pais }}"
                        class="form-control" placeholder="Pais" required>
                </div>
                <div class="col" id="states">
                    <!-- Last name -->
                    <input type="text" name="estado" value="{{ $empresa->Estado }}" class="form-control"
                        placeholder="Estado" required>


                </div>
            </div>

            <div class="form-row mb-4">
                <div class="col" id="cities">
                    <!-- First name -->
                    <input type="text" id="NEmpresa" name="ciudad" value="{{ $empresa->Ciudad }}" class="form-control"
                        placeholder="Ciudad" required>

                </div>
                <div class="col-2">
                    <!-- Last name -->
                    <input type="text" id="RFC" name="CP" value="{{ $empresa->CP }}" class="form-control"
                        placeholder="CP" required>
                </div>
            </div>
            <hr>

            <p class="h4 mb-4 ">Contacto</p>
            <input type="email" id="defaultRegisterFormEmail" value="{{ $empresa->Email }}" name="email"
                class="form-control mb-4" placeholder="E-mail" required>

            <div class="form-row mb-4">
                <div class="col">
                    <!-- First name -->
                    <input type="text" id="NEmpresa" name="telefono" value="{{ $empresa->Telefono }}"
                        class="form-control" placeholder="Teléfono" required>
                </div>
                <div class="col">
                    <!-- Last name -->
                    <input type="text" id="RFC" name="telefono2" value="{{ $empresa->Telefono2 }}" class="form-control"
                        placeholder="Teléfono adicional">
                </div>
            </div>

            <button class="btn btn-mdb-color py-3" style="text-transform: none; width:100%"> Cambiar registro</button>
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
            getCities(1);
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
</script>
@endsection
