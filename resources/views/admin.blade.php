@extends('layouts.app')

@section('content')

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
<div class="border">
    <div class="p-2 pt-3 indigo light-blue darken-4" style="width:100%;min-height:2rem">
        <h2 class="text-left white-text m-1">Compradores <strong>series</strong>
            <a href="/series/create"><button class="btn btn-deep-purple float-right" style="margin:-0.3rem; text-transform:none; background-color:#3F729B!important"><b> <i class="fas fa-plus mr-2"></i>Crear nueva empresa</b></button></a>
            <button type="button" onclick="exportExcel('Compradores Desglose')" class="btn btn-deep-purple float-right mr-4" style="margin:-0.3rem; text-transform:none; background-color:#3F729B!important"><b> <i class="far fa-file-alt mr-2"></i> Generar reporte</b></button></h2>
     </div>
    <div class="mt-4 px-4">
        <table id="dtBasicExample" class="cell-border order-column table  table-hover  stripe mt-4" cellspacing="0" style="width:100%;">
            <thead style="width:100%" class="indigo-text">
                <tr>
                    <th class="th-sm"><b>#</b>
                    </th>
                    <th class="th-sm"><b>Usuario</b>
                    </th>
                    <th class="th-sm"><b>E-mail</b>
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
                    <td>{{$serie->role}}</td>
                    <td class="text-center p-1 noExl" style="width:20%">


                        <form id="delete{{$serie->id}}" action="{{ route('series.destroy', $serie->id) }}" method="POST" >
                            @method('DELETE')
                            @csrf
                             <button type="button" onclick="confirmDelete({{$serie->id}})" class="btn btn-danger" style="text-transform:none"><i class="fas fa-trash mr-2"></i> Borrar</button>

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
        <h2 class="text-left white-text m-1">Usuarios  <strong>permisos</strong>
            <a href="/series/create"><button class="btn btn-deep-purple float-right" style="margin:-0.3rem; text-transform:none; background-color:#3F729B!important"><b> <i class="fas fa-plus mr-2"></i>Crear nueva empresa</b></button></a>
            <button type="button" onclick="exportExcel('Compradores Desglose')" class="btn btn-deep-purple float-right mr-4" style="margin:-0.3rem; text-transform:none; background-color:#3F729B!important"><b> <i class="far fa-file-alt mr-2"></i> Generar reporte</b></button></h2>
     </div>
    <div class="mt-4 px-4">

        <table id="workers" class="cell-border order-column table  table-hover  stripe mt-4" cellspacing="0" style="width:100%;">
            <thead style="width:100%" class="indigo-text">
                <tr>
                    <th class="th-sm"><b>#</b>
                    </th>
                    <th class="th-sm"><b>Usuario</b>
                    </th>
                    <th class="th-sm"><b>E-mail</b>
                    </th>
                    <th class="th-sm"><b>permisos</b>
                    </th>
                    <th class="th-sm noExl"><b>Acciones</b>
                    </th>
                </tr>
            </thead>
            <tbody style="width:100%;">
                @php
                $idNum = 0;
                @endphp
                @foreach ($usuariosRoles as $serie)
                @php
                $idNum++;
                @endphp
                <tr style="">
                    <td style="width:2%">{{$idNum}}</td>
                    <td>{{$serie->name}}</td>
                    <td>{{$serie->email}}</td>
                    <td>
                        @php
                        $rolesE = $serie->role;
                        $rolesE = explode(",",$rolesE);
                        array_pop($rolesE);
                        $count = count($rolesE);
                        @endphp
                        <button class="btn btn-primary" style ="text-transform:none " type="button" data-toggle="collapse" data-target="#collapse{{$serie->id}}" aria-expanded="false" aria-controls="collapse{{$serie->id}}">
                                            Mostrar {{$count}} permisos
                                          </button>

                                        <div class="collapse" id="collapse{{$serie->id}}">
                                          <div class="card card-body">
                                            <ul>
                                                @foreach ($rolesE as $rol)
                                                    <li>{{$rol}}</li>
</li>                                                @endforeach
                                            </ul>  </div>
                                        </div>




                    </td>
                    <td class="text-center p-1 noExl" style="width:20%">


                        <form id="delete{{$serie->id}}" action="{{ route('series.destroy', $serie->id) }}" method="POST" >
                            @method('DELETE')
                            @csrf
                             <button type="button" onclick="confirmDelete({{$serie->id}})" class="btn btn-danger" style="text-transform:none"><i class="fas fa-trash mr-2"></i> Borrar</button>

                        </form>

                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-sm">
    <div class="card mdb">
      <div class="card-body">
        <h5 class="card-title">Roles</h5>
        <ul class="list-group">
            @foreach ($roles as $rol)
        <li class="list-group-item">{{$rol->id."|".$rol->Nombre}}</li>
            @endforeach
    </ul>

      </div>
    </div>
    </div>
    <div class="col-sm">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Tipos de series</h5>
        @foreach ($tipos as $tipo)
        <li class="list-group-item">{{$tipo->id."|".$tipo->Nombre}}</li>
            @endforeach
      </div>
    </div>
    </div>

    </div>
</div>


<!-- Modal  ver mas información-->
<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Información de la empresa</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div id="update">
            ...
        </div>
    </div>
</div>
</div>

<!-- Modal cambiar información-->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Información de la empresa</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div id="editModal">
            ...
        </div>
    </div>
</div>
<script>
      function confirmDelete(id) {
        var result = confirm("El registro se borrará permanentemente. ¿Desea continuar?");
        if (result) {
            document.getElementById("delete" + id).submit();
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
</script>

@endsection
