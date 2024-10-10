<!DOCTYPE html>
<html ng-app="PortalUnico" prueba="true">

<head>
    <meta name="google-site-verification" content="vgE7xTPnRDI9JNHuGHmNQeU55Yr58j9hwq9Wk06R8qk" />
    <title>
        Gobierno del Estado de Colima </title>
    <link rel="SHORTCUT ICON" href="https://openapis.col.gob.mx/API_PU/img/favicon.ico" rel="icon" type="image/x-icon">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://openapis.col.gob.mx/API_PU/css/bs4/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="<?php echo base_url("assets/css/styles.css") ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url("assets/css/ciudadania.css") ?>">
    <script src="https://use.fontawesome.com/releases/v6.6.0/js/all.js" crossorigin="anonymous"></script>

    <!-- Customcss -->

    <!--<link rel="stylesheet" href="https://openapis.col.gob.mx/API_PU/css/bs4/layout.css">-->
    <script type="text/javascript" src="https://openapis.col.gob.mx/API_PU/js/b4/jquery-3.2.1.js"></script>

    <script src='http://localhost:8090/PORTALUNICO/ICSIC/assets/js/customjs.js' type='text/javascript'></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-121812210-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-121812210-1');
    </script>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Arvo" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>

<body data-url="https://openapis.col.gob.mx/API_PU/" id="Body">
    <!-- Navbar -->
    @yield('navbar')
    <!-- Navbar -->
    <div id="layoutSidenav">
        <!-- Menu -->
        <div id="layoutSidenav_nav">
            @yield('menu')
        </div>
        <!-- Contenido -->
        <div id="layoutSidenav_content">
            <main class="main-contenido">
                @yield('contenido')
            </main>
            <!-- Footer -->
            @yield('footer')
        </div>
    </div>
    <!-- Aquí cargamos los scripts JS -->
    @yield('js')
    <script>
        function mostrarPantallaDeCarga() {
            $(".loader").addClass("active");
        }

        function ocultarPantallaDeCarga() {
            $(".loader").removeClass("active");
        }
    </script>

</body>

</html>