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
        <h2 class="text-left white-text m-1">Editar línea
            <a href="/lineas"><button class="btn btn-deep-purple float-right" style="margin:-0.3rem; text-transform:none; background-color:#3F729B!important"><b> <i class="far fa-eye mr-2"></i>Ver registros </b></button></a>
            <a href="/articulos"><button class="btn btn-deep-purple float-right mr-4" style="margin:-0.3rem; text-transform:none; background-color:#3F729B!important"><b> <i class="far fa-eye mr-2 "></i>Artículos </b></button></a>
        </h2>
    </div>

    <form class="text-left border border-light  z-depth-1 white" style="padding:0% 15% 0% 15%;" action="/lineas/{{$linea->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="p-5">
            <p class="h4 mb-4 "> Datos generales</p>

            <div class="form-row mb-4">
                <div class="col">
                    <label>Nombre</label>
                    <input type="text" id="Nombre" autofocus name="nombre" class="form-control" placeholder="Nombre de la línea" value="{{ $linea->Nombre }}" required>
                </div>
                <div class="col">
                    <label>Clave</label>
                    <input type="text" id="Clave" autofocus name="clave" class="form-control" placeholder="Clave" value="{{ $linea->Clave }}" required>
                </div>
                <div class="col">
                    <label>Grupo</label>
                    <select id="grupos" name="grupo" class="form-control" required>
                        @foreach($grupos as $grupo)
                        <option @if($grupo->id == $linea->id_grupo) selected @endif
                            value="{{$grupo->id}}">{{$grupo->Clave." | ".$grupo->Nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <hr>

            <button class="btn btn-mdb-color py-3" style="text-transform: none; width:100%"> Editar línea</button>
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
