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
        <h2 class="text-left white-text m-1">Editar autorización compras
            <a href="/autorizacionesCompras"><button class="btn btn-deep-purple float-right"
                    style="margin:-0.3rem; text-transform:none; background-color:#3F729B!important"><b> <i
                            class="far fa-eye mr-2"></i>Ver registros</b></button></a>
        </h2>
    </div>

    <form class="text-left border border-light  z-depth-1 white" style="padding:0% 15% 0% 15%;" action="/autorizacionesCompras/{{$autorizacion->id}}"
        method="POST">
        @csrf
        @method('PUT')
        <div class="p-5">
            <p class="h4 mb-4 "> Datos generales</p>

            <div class="form-row mb-4">
                <div class="col">
                    <input type="text" id="LInferior" name="linferior" class="form-control"
                        placeholder="Limite inferior" value="{{ $autorizacion->LimiteInferior }}" >
                </div>
                <div class="col">
                    <input type="text" id="LSuperior" name="lsuperior" class="form-control"
                        placeholder="Limite superior" value="{{ $autorizacion->LimiteSuperior }}" >
                </div>
            </div>
            <div class="form-row mb-4">
                <label>Autorizadores</label>

                <select class="form-control" name="usuario">
                    @foreach($usuarios as $usuario)
                    <option type="text" @if($usuario->ID==$autorizacion->id_tipo_usuario) selected @endif class="form-control" value="{{ $usuario->ID }}" placeholder="Ubicacion"
                        required>
                        {{$usuario->Nombre}}
                    </option>
                    @endforeach
                </select>


            </div>
            <hr>

            <button class="btn btn-mdb-color py-3" style="text-transform: none; width:100%"> Actualizar autorización de compras</button>
        </div>
    </form>
</div>
</div>
<script>

</script>
@endsection
