<form action="{{ route('empresas.update', $empresa->id) }}" method="POST">
    @method('PUT')
    @csrf
<div class="modal-body">
    <table style="width:100%">
    <tr>
        <td style="width:35%">Nombre:</td>
        <td style="width:63%"><input type="text" name="nombre" style="width:100%" value="{{$empresa->Nombre}}"></td></tr>
    <tr>
        <td style="width:35%">RFC</td>
        <td style="width:63%"><input type="text" name="rfc" style="width:100%" value="{{$empresa->RFC}}"></td></tr>
    <tr>
        <td style="width:35%">Registro patronal</td>
        <td style="width:63%"><input type="text" name="registropatronal" style="width:100%" value="{{$empresa->RegistroPatronal}}"></td></tr>
    <tr>
        <td style="width:35%">Calle</td>
        <td style="width:63%"><input type="text" name="calle" style="width:100%" value="{{$empresa->Calle}}"></td></tr>
    <tr>
        <td style="width:35%">Número</td>
        <td style="width:63%"><input type="text" name="numero" style="width:100%" value="{{$empresa->Numero}}"></td></tr>
    <tr>
        <td style="width:35%">Colonia</td>
        <td style="width:63%"><input type="text" name="colonia" style="width:100%" value="{{$empresa->Colonia}}"></td></tr>
    <tr>
        <td style="width:35%">Ciudad</td>
        <td style="width:63%"><input type="text" name="ciudad" style="width:100%" value="{{$empresa->Ciudad}}"></td></tr>
    <tr>
        <td style="width:35%">Estado</td>
        <td style="width:63%"><input type="text" name="estado" style="width:100%" value="{{$empresa->Estado}}"></td></tr>
    <tr>
        <td style="width:35%">Pais</td>
        <td style="width:63%"><input type="text" name="pais" style="width:100%" value="{{$empresa->Pais}}"></td></tr>
    <tr>
        <td style="width:35%">Código postal</td>
        <td style="width:63%"><input type="text" name="CP" style="width:100%" value="{{$empresa->CP}}"></td></tr>
    <tr>
        <td style="width:35%">E-mail</td>
        <td style="width:63%"><input type="text" name="email" style="width:100%" value="{{$empresa->Email}}"></td></tr>
    <tr>
        <td style="width:35%">Teléfono</td>
        <td style="width:63%"><input type="text" name="telefono" style="width:100%" value="{{$empresa->Telefono}}"></td></tr>
    <tr>
        <td style="width:35%">Teléfono</td>
        <td style="width:63%"><input type="text" name="telefono2" style="width:100%" value="{{$empresa->Telefono2}}"></td></tr>
    </table>

  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    <button type="submit"  class="btn btn-primary" >
        Actualizar
      </button>
     </div>
</form>
