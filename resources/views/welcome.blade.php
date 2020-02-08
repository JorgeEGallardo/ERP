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
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon">
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
    .map-container{
overflow:hidden;
padding-bottom:56.25%;
position:relative;
height:0;
}
.map-container iframe{
left:0;
top:0;
height:100%;
width:100%;
position:absolute;
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
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <!-- Left -->
          <ul class="navbar-nav mr-auto">

          </ul>

          <!-- Right -->
          <ul class="navbar-nav nav-flex-icons">
          {{Auth::user()->name}}
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
        <a href="#" class="list-group-item  white-text waves-effect" style="background-color:#2C3E4E; width:100%">
          <i class="fas fa-chart-pie mr-3"></i>Principal
        </a>
        <a href="/empresas" class="list-group-item white-text list-group-item-action waves-effect"style="background-color:#2C3E4E; width:100%">
          <i class="fas fa-user mr-3"></i>Empresas</a>
        <a href="#" class="list-group-item white-text list-group-item-action waves-effect" style="background-color:#2C3E4E; width:100%">
          <i class="fas fa-table mr-3"></i>Compradores</a>
        <a href="#" class="list-group-item white-text list-group-item-action waves-effect" style="background-color:#2C3E4E; width:100%">
          <i class="fas fa-map mr-3"></i>Árticulos</a>
        <a href="#" class="list-group-item white-text list-group-item-action waves-effect" style="background-color:#2C3E4E; width:100%">
          <i class="fas fa-money-bill-alt mr-3"></i>Proveedores</a>
      </div>

    </div>
    <!-- Sidebar -->

  </header>
  <!--Main Navigation-->

  <!--Main layout-->
  <main class=" mx-lg-5 mainPage" style="padding-top:5rem">
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
    <a href="/empresas" class="list-group-item white-text list-group-item-action waves-effect"style="background-color:#2C3E4E; width:100%">
        <i class="fas fa-user mr-3"></i>Empresas</a>
    @endif
    @if(in_array("2", $roles))
    <a href="/compradores" class="list-group-item white-text list-group-item-action waves-effect"style="background-color:#2C3E4E; width:100%">
        <i class="fas fa-user mr-3"></i>Compradores</a>
    @endif
    @if(in_array("3", $roles))
    <a href="/empresas" class="list-group-item white-text list-group-item-action waves-effect"style="background-color:#2C3E4E; width:100%">
        <i class="fas fa-user mr-3"></i>Empresas</a>
    @endif
    @if(in_array("4", $roles))
    <a href="/empresas" class="list-group-item white-text list-group-item-action waves-effect"style="background-color:#2C3E4E; width:100%">
        <i class="fas fa-user mr-3"></i>Empresas</a>
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
