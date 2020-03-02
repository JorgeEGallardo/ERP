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
        <h2 class="text-left white-text m-1">Editar artículo
            <a href="/articulos"><button class="btn btn-deep-purple float-right"
                    style="margin:-0.3rem; text-transform:none; background-color:#3F729B!important"><b> <i
                            class="far fa-eye mr-2"></i>Ver registros</b></button></a>
            <a href="/lineas"><button class="btn btn-deep-purple float-right mr-4"
                    style="margin:-0.3rem; text-transform:none; background-color:#3F729B!important"><b> <i
                            class="far fa-eye mr-2"></i>Líneas</b></button></a>

        </h2>
    </div>
    <form class="text-left border border-light  z-depth-1 white" style="padding:0% 15% 0% 15%;"
        action="/articulos/{{$articulo->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="p-5">
            <p class="h4 mb-4 "> Datos generales</p>
            <div class="form-row mb-4">
                <div class="col">
                    <input type="checkbox" checked onchange="claves()" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1" checked>Es artículo</label>
                </div>
            </div>

            <div class="form-row mb-4">
                <div class="col">
                    <label>Clave artículo</label>
                    <input type="text" id="clave" maxlength="5" minlength="5" name="clave" class="form-control"
                        placeholder="Clave Artículo" value="{{$articulo->Clave }}" required>

                </div>
                <div class="col">
                    <label>Clave lote</label>
                    <input type="text" disabled id="clave2" name="clave" class="form-control" placeholder="Clave lote"
                        value="{{$articulo->Clave }}" requiered>
                </div>
            </div>

            <div class="form-row mb-4">
                <div class="col">
                    <label>Descripción</label>
                    <input type="text" id="descripcion" name="descripcion" class="form-control"
                        placeholder="Descripción" value="{{ $articulo->Descripcion }}" required>
                </div>
            </div>
            <div class="form-row mb-4">
                <div class="col">
                    <label>Linea</label>
                    <select id="lineas" name="linea" class="form-control" required>
                        @foreach($lineas as $linea)
                        <option @if($linea->id == $articulo->id_linea) selected @endif
                            value="{{$linea->id}}">{{$linea->Clave." | ".$linea->Nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <!-------
                <div class="col">
                    <label>Proveedores</label>
                    <select id="proveedores" name="proveedor" class="form-control" required>
                        @foreach($proveedores as $proveedor)
                        <option @if($proveedor->id == $articulo->id_proveedor) selected @endif
                            value="{{$proveedor->id}}">{{$proveedor->Nombre}}</option>
                        @endforeach
                    </select>
                </div>
                 <---------->
            </div>

            <hr>
            <p class="h4 mb-4 "> Inventario</p>
            <div class="form-row mb-4">
                <div class="col">
                    <label>Existencia</label>
                    <input type="number" id="existencia" name="existencia" class="form-control" placeholder="Existencia"
                        value="{{ $articulo->Existencia }}">
                </div>
                <div class="col">
                    <label>Mínimo</label>
                    <input type="number" id="minimo" name="minimo" class="form-control" placeholder="Stock mínimo"
                        value="{{ $articulo->Minimo }}">
                </div>
                <div class="col">
                    <label>Máximo</label>
                    <input type="number" id="maximo" name="maximo" class="form-control" placeholder="Stock máximo"
                        value="{{ $articulo->Maximo }}">
                </div>
            </div>
            <div class="form-row mb-4">
                <div class="col">
                    <label>Volumen</label>
                    <input type="number" id="volumen" name="volumen" class="form-control" placeholder="Volumen"
                        value="{{ $articulo->Volumen }}">
                </div>
                <div class="col">
                    <label>Peso</label>
                    <input type="number" id="peso" name="peso" class="form-control" placeholder="Peso"
                        value="{{ $articulo->Peso }}">
                </div>
            </div>
            <div class="form-row mb-4">
                <div class="col">
                    <label>Unidad Entrada</label>
                    <input type="text" id="unidadEntrada" name="unidadentrada" class="form-control"
                        placeholder="Unidad de entrada" value="{{ $articulo->UnidadEntrada }}" required>
                </div>
                <div class="col">
                    <label>Unidad Sálida</label>
                    <input type="text" id="unidadSalida" name="unidadsalida" class="form-control"
                        placeholder="Unidad de sálida" value="{{ $articulo->UnidadSalida }}" required>
                </div>
                <div class="col">
                    <label>Factor de conversión</label>
                    <input type="number" id="factor" name="factor" class="form-control"
                        placeholder="Factor de conversión" value="{{ $articulo->Factor }}" required>
                </div>
            </div>
            <hr>
            <p class="h4 mb-4 "> Fiscales</p>
            <div class="form-row mb-4">
                <div class="col">
                    <label>Clave SAT</label>
                    <input type="text" id="claveSat" name="clavesat" class="form-control" placeholder="Clave Sat"
                        value="{{ $articulo->ClaveSat }}">
                </div>
                <div class="col">
                    <label>Clave Unidad</label>
                    <input type="text" id="claveUnidad" name="claveunidad" class="form-control"
                        placeholder="Clave unidad" value="{{ $articulo->ClaveUnidad }}">
                </div>
            </div>
            <hr>
            <button class="btn btn-mdb-color py-3" style="text-transform: none; width:100%"> Actualizar
                artículo</button>
        </div>
    </form>
</div>
</div>
<script>
     $(document).ready(function() {
    document.getElementById("clave").focus();
});
function claves() {
    document.getElementById('clave').disabled = !document.getElementById('clave').disabled;
    document.getElementById('clave2').disabled = !document.getElementById('clave2').disabled;

}
</script>
@endsection
