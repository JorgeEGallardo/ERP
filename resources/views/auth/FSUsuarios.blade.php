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
        <h2 class="text-left white-text m-1">Asignar series a un usuario
            <a href="/control"><button class="btn btn-deep-purple float-right" style="margin:-0.3rem; text-transform:none; background-color:#3F729B!important"><b>
                        <i class="far fa-eye mr-2"></i>Ver registros</b></button></a>
        </h2>
    </div>

    <form class="text-left border border-light  z-depth-1 white" style="padding:0% 15% 0% 15%;" action="/series/{{$id}}" method="POST">
        @csrf
        <div class="p-5">
        <div class="form-row mb-4">
                <div class="col">
                    <select id="tipo" name="tipo" value="{{ old('tipo') }}" class="form-control" placeholder="tipo" required>
                        @foreach($tipos as $tipo)
                        <option value="{{$tipo->id}}">{{$tipo->Nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col" id="states">
                    <input type="text" name="Nombre" value="{{ old('serie') }}" class="form-control" placeholder="Serie" required>
                </div>
            </div>
            <button class="btn btn-mdb-color py-3" style="text-transform: none; width:100%">
                Agregar nueva serie</button>
        </div>
    </form>
</div>
<div class="mt-4 px-4">
        <table id="dtBasicExample" class="cell-border order-column table  table-hover  stripe mt-4" cellspacing="0"
            style="width:100%;">
            <thead style="width:100%" class="indigo-text">
                <tr>
                    <th class="th-sm"><b>#</b>
                    </th>
                    <th class="th-sm"><b>Serie</b>
                    </th>
                    <th class="th-sm"><b>Tipo</b>
                    </th>

                    <th class="th-sm noExl"><b>Acciones</b>
                    </th>
                </tr>
            </thead>
            <tbody style="width:100%;">
                @php
                $idNum = 0;
                @endphp
                @foreach ($series as $serie)
                @php
                $idNum++;
                @endphp
                <tr >
                    <td style="width:2%">{{$idNum}}</td>
                    <td>{{$serie->Nombre}}</td>
                    <td>{{$serie->Tipo}}</td>
                    <td class="text-center p-1 noExl" style="width:20%">
                        <form id="deleteS{{$serie->id}}" action="{{ route('serie.destroy', $serie->id) }}"
                            method="POST">
                            @method('DELETE')
                            @csrf
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

<script>
    function confirmDelete(id) {
        var result = confirm("El registro se borrará permanentemente. ¿Desea continuar?");
        if (result) {
            document.getElementById("deleteS" + id).submit();
        }
    }
</script>
@endsection
