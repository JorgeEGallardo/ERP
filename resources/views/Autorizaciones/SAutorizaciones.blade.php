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
        <h2 class="text-left white-text m-1">Autorizaciones <strong>departamentos</strong>
            <a href="/autorizaciones"><button class="btn btn-deep-purple float-right"
                    style="margin:-0.3rem; text-transform:none; background-color:#3F729B!important"><b> <i
                            class="far fa-eye mr-2"></i>Ver registros</b></button></a>
        </h2>
    </div>
    <form class="text-left border border-light  z-depth-1 white" style="padding:0% 15% 0% 15%;"
        action="/autorizaciones/{{$user->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="p-5">
            <div class="form-row mb-4">
                <p class="h4 mb-4 "> Autorizador {{$user->name}}</p>
            </div>
            <hr>
            @php
            $Cont=0;
            @endphp
            @foreach($ADepartamentos as $ubicacion)
            <div class="custom-control custom-checkbox">
                <input type="checkbox" onchange="toggle(this, '{{$AUbicaciones[$Cont]->Nombre}}')"
                    class="custom-control-input" id="{{$AUbicaciones[$Cont]->Nombre}}All">
                <label class="custom-control-label" for="{{$AUbicaciones[$Cont]->Nombre}}All"><strong>
                        <h5>{{$AUbicaciones[$Cont]->Nombre}}</h5>
                    </strong></label>
                <a class="btn btn-deep-purple" style="padding:0% 1% 0% 1%; margin:0%" data-toggle="collapse"
                    href="#Collapse{{$AUbicaciones[$Cont]->ID}}" role="button" aria-expanded="false"
                    aria-controls="Collapse{{$AUbicaciones[$Cont]->ID}}">
                    +
                </a>

            </div>
            <div class="collapse" id="Collapse{{$AUbicaciones[$Cont]->ID}}">
                <div class="card card-body">
                    @foreach($ubicacion as $departamento)
                    <div class="custom-control custom-checkbox ml-4">
                        <input type="checkbox" name="departamentos[]" value="{{$departamento->id}}"
                            @if(in_array($departamento->id, $autorizaciones))checked @endif
                        class="custom-control-input {{$AUbicaciones[$Cont]->Nombre}}" id="{{$departamento->id}}CB">
                        <label class="custom-control-label"
                            for="{{$departamento->id}}CB">{{$departamento->Nombre}}</label>
                    </div>
                    @endforeach
                </div>
            </div>
            @php
            $Cont++
            @endphp
            <hr>
            @endforeach
            <button class="btn btn-mdb-color py-3" style="text-transform: none; width:100%"> Editar
                autorizaciones</button>
        </div>
    </form>
</div>
</div>
<script>
function toggle(source, classC) {
    checkboxes = document.getElementsByClassName(classC);
    for (var i = 0, n = checkboxes.length; i < n; i++) {
        checkboxes[i].checked = source.checked;
    }
}
$(document).ready(function() {
    checkboxes = document.getElementsByName('departamentos[]');
    for (var i = 0, n = checkboxes.length; i < n; i++) {
        if (checkboxes[i].checked)
            if (!(checkboxes[i].parentNode.parentNode.parentNode.className = 'show'))
                checkboxes[i].parentNode.parentNode.parentNode.className += " show ";
    }
});
</script>
@endsection
