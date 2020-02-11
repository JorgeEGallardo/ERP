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
        <h2 class="text-left white-text m-1">Asignar permisos a un usuario
            <a href="/control"><button class="btn btn-deep-purple float-right" style="margin:-0.3rem; text-transform:none; background-color:#3F729B!important"><b>
                        <i class="far fa-eye mr-2"></i>Ver registros</b></button></a>
        </h2>
    </div>

    <form class="text-left border border-light  z-depth-1 white" style="padding:0% 15% 0% 15%;" action="/permisos/{{$id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="p-5">
            @foreach ($roles as $rol)
            @if(in_array($rol->id, $rolesUsuario))
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input"  name="roles[]" value="{{$rol->id}}"  id="defaultChecked{{$rol->id}}" checked>
                <label class="custom-control-label" for="defaultChecked{{$rol->id}}">{{$rol->Nombre}}</label>
            </div>
            @else
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="roles[]" value="{{$rol->id}}" id="defaultUnchecked{{$rol->id}}">
                <label class="custom-control-label" for="defaultUnchecked{{$rol->id}}">{{$rol->Nombre}}</label>
            </div>
            @endif
            @endforeach
            <button class="btn btn-mdb-color py-3" style="text-transform: none; width:100%">
                Cambiar los permisos</button>
        </div>
    </form>
</div>
</div>
<script>
</script>
@endsection
