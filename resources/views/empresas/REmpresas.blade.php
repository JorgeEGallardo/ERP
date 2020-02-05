@extends('layouts.app')

@section('content')
<div class="container white p-4" style="">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
<h1 class="text-center mb-4">EMPRESAS</h1>
<a href="empresas/create"><button class="btn btn-deep-purple float-right" > Crear nueva empresa</button></a>
<div class="mt-4">
    <table id="dtBasicExample" class="cell-border order-column stripe mt-4" cellspacing="0" style="width:100%;">
        <thead style="width:100%">
            <tr>
                <th class="th-sm">Empresa
                </th>
                <th class="th-sm">RFC
                </th>
                <th class="th-sm">Ciudad
                </th>
                <th class="th-sm">Email
                </th>
                <th class="th-sm">Teléfono
                </th>
                <th class="th-sm">Acciones
                </th>
            </tr>
        </thead>
        <tbody style="width:100%">
            @foreach ($data as $empresa)
            <tr style="">
                <td>{{$empresa->Nombre}}</td>
                <td>{{$empresa->RFC}}</td>
                <td>{{$empresa->Ciudad}}</td>
                <td>{{$empresa->Email}}</td>
                <td>{{$empresa->Telefono}}</td>
                <td>


                        <form action="{{ route('empresas.destroy', $empresa->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                            <button type="button" onclick="getEmpresa({{$empresa->id}})" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal">
                                <i class="fas fa-info px-1"></i>
                              </button>

                        </form>

            </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>


<!-- Modal  ver mas información-->
<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
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
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
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
</div>

<script>
    function getEmpresa(id){
$.ajax({
    url: '/empresas/'+id,
    type: 'GET',
    success: function(responseText){
        $('#update').html(responseText);
    },
    error: function(responseText){
        alert('error');
    }
});
    }
    function edit(id){
$.ajax({
    url: '/empresas/'+id+'/edit',
    type: 'GET',
    success: function(responseText){
        $('#editModal').html(responseText);
    },
    error: function(responseText){
        alert('error');
    }
});
    }
</script>
@endsection
