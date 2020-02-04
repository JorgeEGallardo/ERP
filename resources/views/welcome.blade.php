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
    .grayBg {
        background-color: #F2F3F5;
    }
.hoverPurple:hover{
color:#2A1061;
}
</style>

<body class="grayBg">
    <!--Page main menu------>
    <div style="margin:2rem;">

        <!--Navbar---------->
        <div class="sidebar-fixed position-fixed  d-none d-lg-block" style="background-color:#F9FAFB; height:100vh">
            <div class="list-group list-group-flush" style="width:17rem;background-color:#F9FAFB;">
                <a href="#" class="list-group-item list-group-item-action waves-effect" style="width:100% !important">
                    <i class="fas fa-user mr-3"></i>Profile
                </a>
                <a href="#" class="list-group-item list-group-item-action waves-effect hoverPurple" style="width:100% !important;">
                    <i class="fas fa-user mr-3"></i>Profile
                </a>
            </div>
        </div>
        <!--Navbar ends----->





        <div>

            <!--Spacer----->
            <div class="spacer  d-none d-lg-inline " style="width:3rem;margin-left:20rem;margin-right:2rem">
                &nbsp;
            </div>
            <!--Spacer ends----->

            <!-- Content-->
            zzzz
            <!-- Content ends-->

        </div>
        <!--Page main menu ends------>
    </div>
</body>

</html>
