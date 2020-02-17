@extends('layouts.app')

@section('content')
<div class="border m-3">

<style>input[type="checkbox"]{
    position: relative;
    width: 80px;
    height: 40px;
    -webkit-appearance: none;
    background: #c6c6c6;
    outline: none;
    border-radius: 20px;
    box-shadow: inset 0 0 5px rgba(255, 0, 0, 0.2);
    transition: .5s;
}
input:checked[type="checkbox"]
{
  background: #03a9f4;
}
input[type="checkbox"]:before
{
  content: '';
  position: absolute;
  width: 40px;
  height: 40px;
  border-radius: 20px;
  top: 0;
  left: 0;
  background: #ffffff;
  transform: scale(1.1);
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
  transition: .5s;
}
input:checked[type="checkbox"]:before
{
  left: 40px;
}</style>
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
        <div style="width:40%; float:left;margin:0px">
        <h2>Tipos de usuario</h2>
            @foreach ($tiposUsuarios as $tipo)
            @if(in_array($tipo->ID, $rolesUsuario))
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input"  name="roles[]" value="{{$tipo->ID}}"  id="defaultChecked{{$tipo->ID}}" checked>
                <label class="custom-control-label" for="defaultChecked{{$tipo->ID}}">{{$tipo->Nombre}}</label>
            </div>
            @else
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="roles[]" value="{{$tipo->ID}}" id="defaultUnchecked{{$tipo->ID}}">
                <label class="custom-control-label" for="defaultUnchecked{{$tipo->ID}}">{{$tipo->Nombre}}</label>
            </div>
            @endif
            @endforeach
        </div>
        <div style="width:40%; margin:0px;float:right">
        <h2>Permisos</h2>
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
        </div>
            <button class="btn btn-mdb-color py-3" style="text-transform: none; width:100%">
                Cambiar los permisos</button>
        </div>
    </form>
</div>
</div>
<script>
</script>
@endsection
