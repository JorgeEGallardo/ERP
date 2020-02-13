@extends('layouts.app')

@section('content')

@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show mt-4">
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
<div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
    <ul>
        <li>{!! \Session::get('success') !!}</li>
    </ul>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<div class="border">
    <div class="p-2 pt-3 indigo light-blue darken-4" style="width:100%;min-height:2rem">
        <h2 class="text-left white-text m-1">Usuarios
            <a href="/registro"><button class="btn btn-deep-purple float-right"
                    style="margin:-0.3rem; text-transform:none; background-color:#3F729B!important"><b> <i
                            class="fas fa-plus mr-2"></i>Crear nuevo usuario</b></button></a>
            <a href="#tipos"><button class="btn btn-deep-purple float-right mr-4"
                    style="margin:-0.3rem; text-transform:none; background-color:#3F729B!important"><b> <i
                            class="fas fa-plus mr-2"></i>Crear nuevo permiso</b></button></a>
            <a href="#permisos"><button class="btn btn-deep-purple float-right mr-4"
                    style="margin:-0.3rem; text-transform:none; background-color:#3F729B!important"><b> <i
                            class="fas fa-plus mr-2"></i>Crear nuevo tipo de serie</b></button></a>
            <button type="button" onclick="exportExcel('Compradores Desglose')"
                class="btn btn-deep-purple float-right mr-4"
                style="margin:-0.3rem; text-transform:none; background-color:#3F729B!important"><b> <i
                        class="far fa-file-alt mr-2"></i> Generar reporte</b></button></h2>
    </div>
    <div class="mt-4 px-4">
        <table id="dtBasicExample" class="cell-border order-column table  table-hover  stripe mt-4" cellspacing="0"
            style="width:100%;">
            <thead style="width:100%" class="indigo-text">
                <tr>
                    <th class="th-sm"><b>#</b>
                    </th>
                    <th class="th-sm"><b>Usuario</b>
                    </th>
                    <th class="th-sm"><b>E-mail</b>
                    </th>
                    <th class="th-sm"><b>Permisos</b>
                    </th>
                    <th class="th-sm"><b>Series</b>
                    </th>
                    <th class="th-sm noExl"><b>Acciones</b>
                    </th>
                </tr>
            </thead>
            <tbody style="width:100%;">
                @php
                $idNum = 0;
                @endphp
                @foreach ($usuariosSeries as $serie)
                @php
                $idNum++;
                @endphp
                <tr style="">
                    <td style="width:2%">{{$idNum}}</td>
                    <td>{{$serie->name}}</td>
                    <td>{{$serie->email}}</td>
                    <td>
                        @php
                        $rolesEp = $usuariosRoles[$idNum-1]->role;
                        $rolesEp = explode(",",$rolesEp);
                        array_pop($rolesEp);
                        $count = count($rolesEp);
                        @endphp
                        @if($count>0)
                        <button class="btn btn-primary" style="text-transform:none"
                            onclick="parentNode.removeChild(this)" type="button" data-toggle="collapse"
                            data-target="#collapseP{{$serie->id}}" aria-expanded="false"
                            aria-controls="collapseP{{$serie->id}}">
                            Mostrar {{$count}} permisos
                        </button>
                        @endif
                        <div class="collapse" id="collapseP{{$serie->id}}">
                            <div class="card card-body">
                                <ul>
                                    @foreach ($rolesEp as $rol)
                                    <li>{{$rol}}</li>
                                    </li> @endforeach
                                </ul>
                            </div>
                        </div>
                    </td>

                    </td>
                    <td>
                        @php
                        $rolesE = $serie->role;
                        $rolesE = explode(",",$rolesE);
                        array_pop($rolesE);
                        $count = count($rolesE);
                        @endphp
                        @if($count>0)
                        <button class="btn btn-primary" style="text-transform:none"
                            onclick="parentNode.removeChild(this)" type="button" data-toggle="collapse"
                            data-target="#collapseS{{$serie->id}}" aria-expanded="false"
                            aria-controls="collapseS{{$serie->id}}">
                            Mostrar {{$count}} series
                        </button>
                        @endif
                        <div class="collapse" id="collapseS{{$serie->id}}">
                            <div class="card card-body">
                                <ul>
                                    @foreach ($rolesE as $rol)
                                    <li>{{$rol}}</li>
                                    </li> @endforeach
                                </ul>
                            </div>
                        </div>
                    </td>
                    <td class="text-center p-1 noExl" style="width:20%">
                        <form id="deleteS{{$serie->id}}" action="{{ route('series.destroy', $serie->id) }}"
                            method="POST">
                            @method('DELETE')
                            @csrf
                            <a href="/permisos/{{$serie->id}}"><button type="button" class="btn btn-primary"
                                    style="text-transform:none">
                                    <i class="fas fa-plus px-1 mr-2"></i>Permisos
                                </button></a>
                            <a href="/series/{{$serie->id}}"><button type="button" class="btn btn-primary"
                                    style="text-transform:none">
                                    <i class="fas fa-plus px-1 mr-2"></i>Series
                                </button></a>
                            <a href="/usuario/{{$serie->id}}"><button type="button" class="btn btn-primary"
                                    style="text-transform:none">
                                    <i class="fas fa-user-edit px-1 mr-2"></i>Usuario
                                </button></a>
                            <button type="button" onclick="confirmDelete({{$serie->id}})" class="btn btn-danger"
                                style="text-transform:none"><i class="fas fa-trash mr-2"></i> Borrar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
<div class="border">
    <div class="p-2 pt-3 indigo light-blue darken-4" style="width:100%;min-height:2rem">
        <h2 class="text-left white-text m-1">Movimientos
            <button type="button" onclick="exportExcelMov('Movimientos Desglose')"
                class="btn btn-deep-purple float-right mr-4"
                style="margin:-0.3rem; text-transform:none; background-color:#3F729B!important"><b> <i
                        class="far fa-file-alt mr-2"></i> Generar reporte</b></button></h2>
    </div>
    <hr>
    <div class="mt-4 px-4">
        <table id="workers" class="cell-border order-column table  table-hover  stripe mt-4" cellspacing="0"
            style="width:100%;">
            <thead style="width:100%" class="indigo-text">
                <tr>
                    <th class="th-sm"><b>#</b>
                    </th>
                    <th class="th-sm"><b>Acción</b>
                    </th>
                    <th class="th-sm"><b>Categoría</b>
                    </th>
                    <th class="th-sm"><b>Usuario</b>
                    </th>
                    <th class="th-sm"><b>Fecha</b>
                    </th>
                </tr>
            </thead>
            <tbody style="width:100%;">
                @foreach ($movimientos as $movimiento)
                <tr style="">
                    <td style="width:2%">{{$movimiento->id}}</td>
                    <td>{{$movimiento->Nombre}}</td>
                    <td>{{$movimiento->Categoria}}</td>
                    <td>{{$movimiento->Usuario}}</td>
                    <td>{{$movimiento->created_at}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
<div class="row" id="permisos">
    <div class="col-sm">
        <div class="card mdb">
            <div class="card-body">
                <h5 class="card-title">Permisos</h5>
                <form class="text-left border border-light  z-depth-1 white" style="padding:0% 1% 0% 1%;"
                    action="/permisos" method="POST">
                    @csrf
                    <div class="p-5">
                        <div class="form-row mb-4">
                            <div class="col" id="states">
                                <input type="text" name="Nombre" value="{{ old('serie') }}" class="form-control"
                                    placeholder="Permiso" required>
                            </div>
                            <div class="col">
                                <button class="btn btn-mdb-color py-1 mb-1" style="text-transform: none; width:100%">
                                    Agregar nuevo permiso</button>
                            </div>
                        </div>
                    </div>
                </form>
                <ul class="list-group">
                    @foreach ($roles as $rol)
                    <li class="list-group-item">{{$rol->id." | ".$rol->Nombre}}</li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>
    <div class="col-sm" id="tipos">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tipos de series</h5>
                <form class="text-left border border-light  z-depth-1 white" style="padding:0% 1% 0% 1%;"
                    action="/series" method="POST">
                    @csrf
                    <div class="p-5">
                        <div class="form-row mb-4">
                            <div class="col" id="states">
                                <input type="text" name="Nombre" value="{{ old('serie') }}" class="form-control"
                                    placeholder="Serie" required>
                            </div>
                            <div class="col">
                                <button class="btn btn-mdb-color py-1 mb-1" style="text-transform: none; width:100%">
                                    Agregar nuevo tipo de serie</button>
                            </div>
                        </div>
                    </div>
                </form>
                @foreach ($tipos as $tipo)
                <li class="list-group-item">{{$tipo->id." | ".$tipo->Nombre}}</li>
                @endforeach
            </div>
        </div>
    </div>

</div>
</div>


<script>
function confirmDelete(id) {
    var result = confirm("El registro se borrará permanentemente. ¿Desea continuar?");
    if (result) {
        document.getElementById("deleteS" + id).submit();
    }
}

var today = new Date();
var dd = today.getDate();
var mm = today.getMonth() + 1; //January is 0!

var yyyy = today.getFullYear();
if (dd < 10) {
    dd = '0' + dd;
}
if (mm < 10) {
    mm = '0' + mm;
}
var today = dd + '-' + mm + '-' + yyyy;

function exportExcel(str) {
    $("#dtBasicExample").table2excel({
        exclude: ".noExl",
        name: "Worksheet Name",
        filename: str + " " + today,
        fileext: ".xls",
        preserveColors: true
    });
}
function exportExcelMov(str) {
    $("#workers").table2excel({
        exclude: ".noExl",
        name: "Worksheet Name",
        filename: str + " " + today,
        fileext: ".xls",
        preserveColors: true
    });
}
</script>

@endsection