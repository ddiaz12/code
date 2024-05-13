<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('titulo')</title>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ base_url('assets/') }}js/scripts.js"></script>

    <!-- Aquí cargamos los estilos CSS -->
    @yield('estilos')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ base_url('assets/') }}css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ base_url('assets/') }}css/base.css">

</head>

<body class="sb-nav-fixed cuerpo-sujeto">

    <!-- Navbar -->
    @include('templates/navbar')
    <!-- Navbar -->

    <div id="layoutSidenav">

        <!-- Menu -->
        @include('templates/menu')
        <!-- Menu -->

        <!-- Contenido -->
        <div id="layoutSidenav_content" class="div-contenido">
            <main class="main-contenido">
                <div class="container-fluid px-4">
                    <h1 class="mt-4 titulo-menu">@yield('titulo_menu')</h1>

                    <div class="row">
                        @yield('contenido')
                    </div>

                </div>
            </main>

            <!-- Footer -->
            @include('templates/footer')
            <!-- Footer -->
        </div>
        <!-- Contenido -->
    </div>

    @yield('scripts')

</body>

</html>
