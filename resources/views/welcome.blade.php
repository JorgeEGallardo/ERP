<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menu principal</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Styles -->
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
</head>
<style>
.map-container {
    overflow: hidden;
    padding-bottom: 56.25%;
    position: relative;
    height: 0;
}

.map-container iframe {
    left: 0;
    top: 0;
    height: 100%;
    width: 100%;
    position: absolute;
}

.dropdown2 {
    position: relative;
    display: inline-block;
}

.dropdown2-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
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

.center {
    float: left;
}

.card {
    width: 450px;
    height: 200px;
    background-color: #2C3E4E;
    background: linear-gradient(#f8f8f8, #fff);
    box-shadow: 0 8px 16px -8px rgba(0, 0, 0, 0.4);
    border-radius: 6px;
    overflow: hidden;
    position: relative;
    margin: 1rem;
}

.card h2 {
    text-align: center;

}

.card .additional {
    position: absolute;
    width: 150px;
    height: 100%;
    background: linear-gradient(#2C3E4E, #2C3E5E);
    transition: width 0.4s;
    overflow: hidden;
    z-index: 2;
}

.card.green .additional {
    background: linear-gradient(#92bCa6, #A2CCB6);
}


.card:hover .additional {
    width: 100%;
    border-radius: 0 5px 5px 0;
}

.card .additional .user-card {
    width: 150px;
    height: 100%;
    position: relative;
    float: left;
}

.card .additional .user-card::after {
    content: "";
    display: block;
    position: absolute;
    top: 10%;
    right: -2px;
    height: 80%;
    border-left: 2px solid rgba(0, 0, 0, 0.025);

}

.card .additional .user-card .level,
.card .additional .user-card .points {
    top: 15%;
    color: #fff;
    text-transform: uppercase;
    font-size: 0.75em;
    font-weight: bold;
    background: rgba(0, 0, 0, 0.15);
    padding: 0.125rem 0.75rem;
    border-radius: 100px;
    white-space: nowrap;
}

.card .additional .user-card .points {
    top: 85%;
}

.card .additional .user-card img {
    top: 50%;
}

.card .additional .more-info {
    width: 300px;
    float: left;
    position: absolute;
    left: 150px;
    height: 100%;
}

.card .additional .more-info h2 {
    color: #fff;
    margin-bottom: 0;
}

.card.green .additional .more-info h2 {
    color: #224C36;
}

.card .additional .coords {
    margin: 0 1rem;
    color: #fff;
    font-size: 1rem;
}

.card.green .additional .coords {
    color: #325C46;
}

.card .additional .coords span+span {
    float: right;
}

.card .additional .stats {
    font-size: 2rem;
    display: flex;
    position: relative;
    top: 1.5rem;
    color: #fff;
}

.card.green .additional .stats {
    color: #325C46;
}

.card .additional .stats>div {
    flex: 1;
    text-align: center;
}

.card .additional .stats i {
    display: block;
}

.card .additional .stats div.title {
    font-size: 0.9rem;
    font-weight: bold;
    text-transform: uppercase;
}

.card .additional .stats div.title:hover {
    font-size: 1.1rem;
}


.card .additional .stats div.value {
    font-size: 1.5rem;
    font-weight: bold;
    line-height: 1.5rem;
}

.card .additional .stats div.value.infinity {
    font-size: 2.5rem;
}

.card .general {
    width: 300px;
    height: 100%;
    position: absolute;
    top: 0;
    right: 0;
    z-index: 1;
    box-sizing: border-box;
    padding: 1rem;
    padding-top: 0;
}

.card .general .more {
    position: absolute;
    bottom: 1rem;
    right: 1rem;
    font-size: 0.9em;
}
</style>

<body class="grey lighten-3">
    <!--Main Navigation-->
    <header>
        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
            <div class="container-fluid">
                <!-- Brand -->
                <a class="navbar-brand waves-effect" href="/">
                    <strong class="blue-text">ERP B</strong>
                </a>
                <!-- Collapse -->
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Links -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left -->
                    <ul class="navbar-nav mr-auto">
                    </ul>
                    <!-- Right -->
                    <ul class="navbar-nav nav-flex-icons">
                        @if(isset(Auth::user()->name))
                        <div class="dropdown2 mr-4">
                            <span>{{Auth::user()->name}}</span>
                            <div class="dropdown2-content">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Cerrar sesión') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Navbar -->
        <!-- Sidebar -->
        <div class="sidebar-fixed position-fixed " style="background-color:#2C3E4E">
            <a class="logo-wrapper waves-effect">
                <img src="https://mdbootstrap.com/img/logo/mdb-email.png" class="img-fluid" alt="">
            </a>
            <div class="list-group list-group-flush" style="background-color:#2C3E4E; width:100%">
                <a href="#" class="list-group-item  white-text waves-effect"
                    style="background-color:#2C3E4E; width:100%">
                    <i class="fas fa-chart-pie mr-3"></i>Principal
                </a>
                <a href="/empresas" class="list-group-item white-text list-group-item-action waves-effect"
                    style="background-color:#2C3E4E; width:100%">
                    <i class="fas fa-user mr-3"></i>Empresas</a>
                <a href="#" class="list-group-item white-text list-group-item-action waves-effect"
                    style="background-color:#2C3E4E; width:100%">
                    <i class="fas fa-table mr-3"></i>Compradores</a>
                <a href="#" class="list-group-item white-text list-group-item-action waves-effect"
                    style="background-color:#2C3E4E; width:100%">
                    <i class="fas fa-map mr-3"></i>Árticulos</a>
                <a href="#" class="list-group-item white-text list-group-item-action waves-effect"
                    style="background-color:#2C3E4E; width:100%">
                    <i class="fas fa-money-bill-alt mr-3"></i>Proveedores</a>
            </div>
        </div>
        <!-- Sidebar -->
    </header>
    <!--Main Navigation-->
    <!--Main layout-->
    <main class=" mx-lg-5 mainPage" style="padding-top:5rem">
        <!--
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mt-4">
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
        @if(in_array("1", $roles))
        <a href="/empresas" class="list-group-item white-text list-group-item-action waves-effect"
            style="background-color:#2C3E4E; width:100%">
            <i class="fas fa-user mr-3"></i>Empresas</a>
        @endif
        @if(in_array("6", $roles))
        <a href="/departamentos" class="list-group-item white-text list-group-item-action waves-effect"
            style="background-color:#2C3E4E; width:100%">
            <i class="fas fa-user mr-3"></i>Departamentos</a>
        @endif
        @if(in_array("11", $roles))
        <a href="/proveedores" class="list-group-item white-text list-group-item-action waves-effect"
            style="background-color:#2C3E4E; width:100%">
            <i class="fas fa-user mr-3"></i>Proveedores</a>
        @endif
        @if(in_array("16", $roles))
        <a href="/articulos" class="list-group-item white-text list-group-item-action waves-effect"
            style="background-color:#2C3E4E; width:100%">
            <i class="fas fa-user mr-3"></i>Árticulos</a>
        @endif
        @if(in_array("101", $roles))
        <a href="/control" class="list-group-item white-text list-group-item-action waves-effect"
            style="background-color:#2C3E4E; width:100%">
            <i class="fas fa-user mr-3"></i> Panel <strong>Administrador</strong></a>
        @endif
--->
    @if(in_array("1", $roles))
        <a href="/empresas">
            <div class="center">
                <div class="card">
                    <div class="additional">
                        <div class="user-card">
                            <div class="level center">
                                Administrador
                            </div>
                        </div>
                        <div class="more-info">
                            <h2>Empresas</h2>
                            <div class="stats">
                                <div>
                                    <a style="color:white" href="/empresas">
                                        <div class="title">Registros
                                            <i class="fa fa-table"></i>
                                            <div class="value"><i class="fa fa-angle-double-right"></i></div>
                                        </div>
                                    </a>
                                </div>
                                <div>
                                    <a style="color:white" href="/empresas/create">
                                        <div class="title">Altas
                                            <i class="fa fa-plus"></i>
                                            <div class="value"><i class="fa fa-angle-double-right"></i></div>
                                        </div>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="general">
                        <h2>Empresas</h2>
                    </div>
                </div>
            </div>
        </a>
        @endif
        @if(in_array("6", $roles))
        <a href="/departamentos">
            <div class="center">
                <div class="card">
                    <div class="additional">
                        <div class="user-card">
                            <div class="level center">
                                Administrador
                            </div>
                        </div>
                        <div class="more-info">
                            <h2>Departamentos</h2>
                            <div class="stats">
                                <div>
                                    <a style="color:white" href="/departamentos">
                                        <div class="title">Registros
                                            <i class="fa fa-table"></i>
                                            <div class="value"><i class="fa fa-angle-double-right"></i></div>
                                        </div>
                                    </a>
                                </div>
                                <div>
                                    <a style="color:white" href="/departamentos/create">
                                        <div class="title">Altas
                                            <i class="fa fa-plus"></i>
                                            <div class="value"><i class="fa fa-angle-double-right"></i></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="general">
                        <h2>Departamentos</h2>
                    </div>
                </div>
            </div>
        </a>
        @endif

        <a href="/autorizaciones">
            <div class="center">
                <div class="card">
                    <div class="additional">
                        <div class="user-card">
                            <div class="level center">
                                Administrador
                            </div>
                        </div>
                        <div class="more-info">
                            <h2>Autorizaciones</h2>
                            <div class="stats">
                                <div>
                                    <a style="color:white" href="/autorizaciones">
                                        <div class="title">Requisiones
                                            <i class="fa fa-box"></i>
                                            <div class="value"><i class="fa fa-angle-double-right"></i></div>
                                        </div>
                                    </a>
                                </div>
                                <div>
                                    <a style="color:white" href="/autorizacionesCompras">
                                        <div class="title">Compras
                                            <i class="fa fa-plus"></i>
                                            <div class="value"><i class="fa fa-money-bill-wave-alt"></i></div>
                                        </div>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="general">
                        <h2>Autorizaciones</h2>
                    </div>
                </div>
            </div>
        </a>
        @if(in_array("11", $roles))
        <a href="/proveedores">
            <div class="center">
                <div class="card">
                    <div class="additional">
                        <div class="user-card">
                            <div class="level center">
                                Administrador
                            </div>
                        </div>
                        <div class="more-info">
                            <h2>Proveedores</h2>
                            <div class="stats">
                                <div>
                                    <a style="color:white" href="/proveedores">
                                        <div class="title">Registros
                                            <i class="fa fa-table"></i>
                                            <div class="value"><i class="fa fa-angle-double-right"></i></div>
                                        </div>
                                    </a>
                                </div>
                                <div>
                                    <a style="color:white" href="/proveedores/create">
                                        <div class="title">Altas
                                            <i class="fa fa-plus"></i>
                                            <div class="value"><i class="fa fa-angle-double-right"></i></div>
                                        </div>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="general">
                        <h2>Proveedores</h2>
                    </div>
                </div>
            </div>
        </a>
        @endif
        @if(in_array("101", $roles))
        <a href="/control">
            <div class="center">
                <div class="card">
                    <div class="additional">
                        <div class="user-card">
                            <div class="level center">
                                Administrador
                            </div>
                        </div>
                        <div class="more-info">
                            <h2>Adminstrador</h2>
                            <div class="stats">
                                <div>
                                    <a style="color:white" href="/control">
                                        <div class="title">Registros
                                            <i class="fa fa-table"></i>
                                            <div class="value"><i class="fa fa-angle-double-right"></i></div>
                                        </div>
                                    </a>
                                </div>
                                <div>
                                    <a style="color:white" href="/register">
                                        <div class="title">Usuarios
                                            <i class="fa fa-user"></i>
                                            <div class="value"><i class="fa fa-angle-double-right"></i></div>
                                        </div>
                                    </a>
                                </div>
                                <div>
                                    <a style="color:white" href="/control#movimientos">
                                        <div class="title">Movimientos
                                            <i class="fa fa-plus"></i>
                                            <div class="value"><i class="fa fa-angle-double-right"></i></div>
                                        </div>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="general">
                        <h2>Administrador</h2>
                    </div>
                </div>
            </div>
        </a>
        @endif
    </main>
    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Initializations -->
</body>

</html>
