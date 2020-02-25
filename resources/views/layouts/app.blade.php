<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="icon" href="img/mdb-favicon.png" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="{{asset('css/mdb.min.css')}}">
    <!-- Your custom styles (optional) -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <style>

    </style>

    <link href="{{asset('css/addons/datatables.min.css')}}" rel="stylesheet">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .dropdown2 {
            position: relative;
            display: inline-block;
        }

        .dropdown2-content {
            display: none;
            margin-left: -50%;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 200px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown2-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }


        .dropdown2:hover .dropdown2-content {
            display: block;
        }

        .notify {
            border-radius: 5%;
            width: 16rem;
            display: block;
            overflow: hidden;
        }

        .notify img {
            width: 1rem;
            margin-right: 0.5rem;

            margin-bottom: 0.5rem;
        }

        .badge2 {
            position: absolute;
            top: -10px;
            right: 10px;
            padding: 2% 10% 2% 10%;
            border-radius: 50%;
            background: red;
            color: white;
        }
    </style>
</head>

<body style="background-color: #F2F3F5;">
    @if(isset(Auth::user()->name))
    @php
    $avisos=\DB::select('select * from avisos');
    $avisosC = count($avisos);
    $avisoImg=array('ey','alerta.svg','ey');
    $empresas = \DB::select('select * from empresas');
    if(!Session::has('empresa')){
    \session::put('empresa', $empresas[0]->id);
    \session::put('empresaN', $empresas[0]->Nombre);
    }
    $sEmpresa = Session::get('empresa');
    $sNombre = Session::get('empresaN');
    $url = url()->current();
    $url = explode('/', $url);
    if(isset($url[3]))
        $url=$url[3];
    else
        $url="";
    @endphp
    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
        <div class="container-fluid">

            <!-- Brand -->
            <p class="navbar-brand waves-effect" >
                <h4 class="orange-text" style="text-transform:uppercase">
                    <a href="/"> <strong class="blue-text">ERP B /</strong></a>
                    <a href="/" class="orange-text" ><strong> {{$sNombre}}  </strong></a>/
                    <a href="/" class="orange-text">{{$url}}</a>
                </h4>
            </p>

            <!-- Collapse -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Links -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <!-- Left -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right -->
                <ul class="navbar-nav nav-flex-icons">


                    <div class="dropdown2 mr-4">
                        @if($avisosC>0)
                        <span class="badge2" style="font-size:12px"><strong>{{$avisosC}}</strong></span>
                        @endif
                        <span>
                            <h3><i class="far fa-comments mr-4"></i></h3>
                        </span>
                        <div class="dropdown2-content">
                            <div class="notify">
                                <ul class="list-group">
                                    @foreach($avisos as $aviso)
                                    <li class="list-group-item"><img src="img/{{$avisoImg[$aviso->tipo]}}" alt="Avatar">
                                        <strong>{{$aviso->titulo}}</strong>
                                        <hr style="margin:0px">
                                        {{$aviso->mensaje}}
                                    </li>
                                    @endforeach
                                </ul>

                            </div>
                        </div>
                    </div>

                    <div class="dropdown2 mr-4">
                        <select class="form-control" style="min-width:15rem" onchange="window.location = '/cambioEmpresa/'+this.value" name="autorizador">
                            @foreach($empresas as $empresa)
                            <option type="text" class="form-control" value="{{ $empresa->id}}" placeholder="Ubicacion" required @if($empresa->id==$sEmpresa) selected @endif>
                                {{$empresa->Nombre}}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="dropdown2 mr-4">
                        <h5 class="mt-2"><strong><span>{{Auth::user()->name}}</span></strong>
                            <h5>
                                <div class="dropdown2-content">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                    </div>
                    @endif

                </ul>

            </div>

        </div>
    </nav>
    <div id="app" class=" z-depth-1" style="margin:2rem; background-color:#ffffff; min-height:92vh">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
        <main class="py-4  ">
            @yield('content')
        </main>
    </div>
    <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="{{asset('js/mdb.min.js')}}"></script>
    <!-- Your custom scripts (optional) -->
    <script type="text/javascript" src="{{asset('js/jquery.table2excel.js')}}"></script>
    <!-- MDBootstrap Datatables  -->
    <script type="text/javascript" src="{{asset('js/addons/datatables.min.js')}}"></script>
    <script type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $.noConflict();
            $('#workers').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
        $(document).ready(function() {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
</body>

</html>
