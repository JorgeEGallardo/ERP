@extends('layouts.app')

@section('content')
@php
$roles = Auth::user()->role;
$roles = explode(",",$roles);
@endphp
<div class="container white p-4" style="max-width:10000rem">
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
            <h2 class="text-left white-text m-1">Proveedores
                @if(in_array("12", $roles))
                <a href="/proveedores/create"><button class="btn btn-deep-purple float-right"
                        style="margin:-0.3rem; text-transform:none; background-color:#3F729B!important"><b> <i
                                class="fas fa-plus mr-2"></i>Crear nuevo proveedor</b></button></a>
                @endif
                @if(in_array("15", $roles))
                <button type="button" onclick="exportExcel('Proveedores Desglose')"
                    class="btn btn-deep-purple float-right mr-4"
                    style="margin:-0.3rem; text-transform:none; background-color:#3F729B!important"><b> <i
                            class="far fa-file-alt mr-2"></i> Generar reporte</b></button></h2>
            @endif
        </div>
        <div class="mt-4 px-4">
            <table id="dtBasicExample" class="cell-border order-column table  table-hover  stripe mt-4" cellspacing="0"
                style="width:100%;">
                <thead style="width:100%" class="indigo-text">
                    <tr>
                        <th class="th-sm"><b>#</b>
                        </th>
                        <th class="th-sm"><b>Nombre</b>
                        </th>
                        <th class="th-sm"><b>Calle</b>
                        </th>
                        <th class="th-sm"><b>Colonia</b>
                        </th>
                        <th class="th-sm"><b>Población</b>
                        </th>
                        <th class="th-sm"><b>Municipio</b>
                        </th>
                        <th class="th-sm noExl"><b>Acciones</b>
                        </th>
                    </tr>
                </thead>
                <tbody style="width:100%;">
                    @php
                    $idNum = 0;
                    @endphp
                    @foreach ($proveedores as $proveedor)
                    @php
                    $idNum++;
                    @endphp
                    <tr >
                        <td style="width:2%">{{$idNum}}</td>
                        <td>{{$proveedor->Nombre}}</td>
                        <td>{{$proveedor->Calle}}
                        @isset($proveedor->NExt)
                         # {{$proveedor->NExt}}
                        @endisset
                        @isset($proveedor->Nint)
                          Int: {{$proveedor->Nint}}
                        @endisset
                        </td>
                        <td>{{$proveedor->Poblacion}}</td>
                        <td>{{$proveedor->Colonia}}</td>
                        <td>{{$proveedor->Estado}},{{$proveedor->Municipio}}</td>
                        <td class="text-center p-1 noExl" style="width:20%">


                            <form id="delete{{$proveedor->id}}"
                                action="{{ route('proveedores.destroy', $proveedor->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <a href="/proveedores/{{$proveedor->id}}"><button type="button" class="btn btn-primary"
                                        style="text-transform:none">
                                        <i class="fas fa-info px-1 mr-2"></i>Desglose
                                    </button></a>
                                @isset($roles)
                                @if(in_array("13", $roles))
                                <button type="button" onclick="confirmDelete({{$proveedor->id}})" class="btn btn-danger"
                                    style="text-transform:none"><i class="fas fa-trash mr-2"></i> Borrar</button>
                                @endif
                                @endisset

                            </form>

                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
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

function getEmpresa(id) {
    $.ajax({
        url: '/empresas/' + id,
        type: 'GET',
        success: function(responseText) {
            $('#update').html(responseText);
        },
        error: function(responseText) {

        }
    });
}

function edit(id) {
    $.ajax({
        url: '/empresas/' + id + '/edit',
        type: 'GET',
        success: function(responseText) {
            $('#editModal').html(responseText);
        },
        error: function(responseText) {

        }
    });
}

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
