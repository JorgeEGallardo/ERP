@extends('layouts.app')
@section('content')
<!----Mensajes de error---->
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
    <!----Mensajes de éxito---->
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <!----Comienzo del formulario---->
    <div class="p-2 pt-3 indigo light-blue darken-4" style="width:100%;min-height:2rem">
        <h2 class="text-left white-text m-1">Crear nuevo artículo
            <a href="/articulos"><button class="btn btn-deep-purple float-right"
                    style="margin:-0.3rem; text-transform:none; background-color:#3F729B!important"><b> <i
                            class="far fa-eye mr-2"></i>Ver registros</b></button></a>
            <a href="/lineas"><button class="btn btn-deep-purple float-right mr-4"
                    style="margin:-0.3rem; text-transform:none; background-color:#3F729B!important"><b> <i
                            class="far fa-eye mr-2"></i>Líneas</b></button></a>

        </h2>
    </div>
    <form class="text-left border border-light  z-depth-1 white" style="padding:0% 15% 0% 15%;" action="/articulos"
        method="POST">
        @csrf
        <div class="p-5">
            <p class="h4 mb-4 "> Datos generales</p>
            <div class="form-row mb-4">
                <div class="col">
                    <input type="text" id="clave" name="clave" class="form-control" placeholder="Clave"
                        value="{{ old('clave') }}" required>
                </div>
                <div class="col">
                    <input type="text" id="claveAdicional" name="claveadicional" class="form-control"
                        placeholder="Clave adicional" value="{{ old('claveadicional') }}">
                </div>
            </div>
            <div class="form-row mb-4">
                <div class="col">
                    <input type="text" id="descripcion" name="descripcion" class="form-control"
                        placeholder="Descripción" value="{{ old('descripcion') }}" required>
                </div>
            </div>
            <div class="form-row mb-4">
                <div class="col">
                    <label>Linea</label>
                    <select id="lineas" name="linea" class="form-control" required>
                        @foreach($lineas as $linea)
                        <option value="{{$linea->id}}">{{$linea->Clave." | ".$linea->Nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label>Proveedores</label>
                    <select id="proveedores" name="proveedor" class="form-control" required>
                        @foreach($proveedores as $proveedor)
                        <option value="{{$proveedor->id}}">{{$proveedor->Nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <hr>
            <p class="h4 mb-4 "> Inventario</p>
            <div class="form-row mb-4">
                <div class="col">
                    <input type="number" id="existencia" name="existencia" class="form-control" placeholder="Existencia"
                        value="{{ old('existencia') }}">
                </div>
                <div class="col">
                    <input type="number" id="minimo" name="minimo" class="form-control" placeholder="Stock mínimo"
                        value="{{ old('minimo') }}">
                </div>
                <div class="col">
                    <input type="number" id="maximo" name="maximo" class="form-control" placeholder="Stock máximo"
                        value="{{ old('maximo') }}">
                </div>
            </div>
            <div class="form-row mb-4">
                <div class="col">
                    <input type="number" id="volumen" name="volumen" class="form-control" placeholder="Volumen"
                        value="{{ old('volumen') }}">
                </div>
                <div class="col">
                    <input type="number" id="peso" name="peso" class="form-control" placeholder="Peso"
                        value="{{ old('peso') }}">
                </div>
            </div>
            <div class="form-row mb-4">
                <div class="col">
                    <input type="text" id="unidadEntrada" name="unidadentrada" class="form-control"
                        placeholder="Unidad de entrada" value="{{ old('unidadentrada') }}" required>
                </div>
                <div class="col">
                    <input type="text" id="unidadSalida" name="unidadsalida" class="form-control"
                        placeholder="Unidad de sálida" value="{{ old('unidadsalida') }}" required>
                </div>
                <div class="col">
                    <input type="number" id="factor" name="factor" class="form-control"
                        placeholder="Factor de conversión" value="{{ old('factor') }}" required>
                </div>
            </div>
            <hr>
            <p class="h4 mb-4 "> Fiscales</p>
            <div class="form-row mb-4">
                <div class="col">
                    <input type="text" id="claveSat" name="clavesat" class="form-control" placeholder="Clave Sat"
                        value="{{ old('clavesat') }}">
                </div>
                <div class="col">
                    <input type="text" id="claveUnidad" name="claveunidad" class="form-control"
                        placeholder="Clave unidad" value="{{ old('claveunidad') }}">
                </div>
            </div>
            <hr>
            <button class="btn btn-mdb-color py-3" style="text-transform: none; width:100%"> Crear nuevo
                árticulo</button>
        </div>
    </form>
</div>
</div>
@endsection
