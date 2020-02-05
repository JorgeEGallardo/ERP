<div class="modal-body">
    <table>
    <tr><td style="width:35%">Nombre:</td><td>{{$empresa->Nombre}}</td></tr>
    <tr><td style="width:35%">RFC</td><td>{{$empresa->RFC}}</td></tr>
    <tr><td style="width:35%">Registro patronal</td><td>{{$empresa->RegistroPatronal}}</td></tr>
    <tr><td style="width:35%">Calle</td><td>{{$empresa->Calle}}</td></tr>
    <tr><td style="width:35%">Número</td><td>{{$empresa->Numero}}</td></tr>
    <tr><td style="width:35%">Colonia</td><td>{{$empresa->Colonia}}</td></tr>
    <tr><td style="width:35%">Ciudad</td><td>{{$empresa->Ciudad}}</td></tr>
    <tr><td style="width:35%">Estado</td><td>{{$empresa->Estado}}</td></tr>
    <tr><td style="width:35%">Pais</td><td>{{$empresa->Pais}}</td></tr>
    <tr><td style="width:35%">Código postal</td><td>{{$empresa->CP}}</td></tr>
    <tr><td style="width:35%">E-mail</td><td>{{$empresa->Email}}</td></tr>
    <tr><td style="width:35%">Teléfono</td><td>{{$empresa->Telefono}}</td></tr>
    <tr><td style="width:35%">Teléfono</td><td>{{$empresa->Telefono2}}</td></tr>
    </table>

  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    <button type="button" onclick="edit({{$empresa->id}})" class="btn btn-primary"  data-dismiss="modal" data-toggle="modal" data-target="#edit">
        Editar
      </button>
     </div>
