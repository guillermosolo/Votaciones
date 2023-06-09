<!DOCTYPE html>
<html lang="es-GT">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('titulo','Menú') | Votaciones</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset("assets/$theme/plugins/fontawesome-free/css/all.min.css")}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset("assets/$theme/plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset("assets/$theme/dist/css/adminlte.min.css")}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset("assets/$theme/plugins/overlayScrollbars/css/OverlayScrollbars.min.css")}}">
    @yield('styles')
    <link rel="stylesheet" href="{{asset("assets/css/custom.css")}}">
    <!-- Bootstrap laravel -->

    <!-- Styles -->
    <link href="{{asset('css/app.css') }}" rel="stylesheet">
    <!-- Google Font: Source Sans Pro -->
    <link href="{{asset("assets/css/SansPro.css")}}" rel="stylesheet">
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <!-- Inicio Header -->
        @include("theme/$theme/header")
        <!-- Fin Header  -->
        <!-- Inicio Aside -->
        @yield('aside')
        <!-- Fin Aside -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid" >
                    <div class="row mb-2">
                        <div class="d-none d-sm-block col-lg-6">
                         <!--   <h1 class="m-0 text-dark">@yield('titulo','')</h1> -->
                        </div><!-- /.col -->
                    </div>
                </div>
                @yield('contenido')
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
        </div>
        <!-- Inicio Footer -->
        @include("theme/$theme/footer")
        <!-- Fin Footer-->
    </div>
    <!-- Scripts
    <script src="{{ asset('js/app.js') }}"></script> -->
    <!-- jQuery -->
    <script src="{{asset("assets/$theme/plugins/jquery/jquery.min.js")}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset("assets/$theme/plugins/jquery-ui/jquery-ui.min.js")}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset("assets/$theme/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset("assets/$theme/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")}}"></script>
    <!-- Bootstrap Switch -->
    <script src="{{asset("assets/$theme/plugins/bootstrap-switch/js/bootstrap-switch.min.js")}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset("assets/$theme/dist/js/adminlte.js")}}"></script>
    @yield('scriptPlugins')
    <!-- <jQuery Validation -->
    <script src="{{asset("assets/js/jquery-validation/jquery.validate.min.js")}}"> </script>
    <script src="{{asset("assets/js/jquery-validation/localization/messages_es.min.js")}}"> </script>
    <!-- SweetAlert2 -->
    <script src="{{asset("assets/$theme/plugins/sweetalert2/sweetalert2.all.min.js")}}"></script>
    <!-- Input Spinner -->
    <script src="{{asset("assets/js/input-spinner/bootstrap-input-spinner.js")}}"></script>

    <script src="{{asset("assets/js/scripts.js")}}"></script>
    <script src="{{asset("assets/js/funciones.js")}}"></script>
    @yield("scripts")
</body>

</html>
