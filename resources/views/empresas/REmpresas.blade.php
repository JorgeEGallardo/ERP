@extends('layouts.app')

@section('content')
<div class="container white" style="margin:5%">
    <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
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
        <tbody>
            @foreach ($data as $empresa)
            <tr>
                <td>{{$empresa->Nombre}}</td>
                <td>{{$empresa->RFC}}</td>
                <td>{{$empresa->Ciudad}}</td>
                <td>{{$empresa->Email}}</td>
                <td>{{$empresa->Telefono}}</td>
                <td>
                    <a href="/empresas/{{$empresa->id}}">ver</a>
                    <a href="">Editar</a>
                    <a href="/empresas/{{$empresa->id}}">
                        <form action="{{ route('empresas.destroy', $empresa->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button>Borrar</button>
                        </form>
                    </a></td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
