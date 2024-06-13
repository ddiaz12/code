<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('titulo')</title>

    <!-- Aquí cargamos los estilos CSS -->
    @yield('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <link href= "<?php echo site_url('assets/css/styles.css'); ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo site_url('assets/css/base.css'); ?>">

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="<?php echo base_url('assets/'); ?>js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="sb-nav-fixed cuerpo-sujeto">
    <!-- Navbar -->
    @yield('navbar')
    <!-- Navbar -->
    <div id="layoutSidenav">
        <!-- Menu -->
        @yield('menu')
        <!-- Menu -->
        <!-- Contenido -->
        <div id="layoutSidenav_content" class="div-img">
            <main class="main-contenido">
                @yield('contenido')
            </main>
            <!-- Footer -->
            @yield('footer')
            <!-- Footer -->
        </div>
        <!-- Contenido -->
    </div>
    <!-- Aquí cargamos los scripts JS -->
    @yield('js')
    <script>
        var timeout;
        var timerElement = document.getElementById('timer');
        var timeLeft = 10 * 60; // 10 minutes in seconds

        function logout() {
            alert('Tu sesión ha expirado. Serás redirigido a la página de inicio de sesión.');
            window.location.href = '<?= base_url('auth/logout') ?>';
        }

        function resetTimer() {
            clearTimeout(timeout);
            timeLeft = 10 * 60; // Reset the time left to 10 minutes
            timeout = setTimeout(logout, timeLeft * 1000);
        }

        // Detect user interaction and reset the timer
        window.onload = resetTimer;
        document.onmousemove = resetTimer;
        document.onkeypress = resetTimer;

        // Update the timer every second
        setInterval(function() {
            timeLeft--;
            var minutes = Math.floor(timeLeft / 60);
            var seconds = timeLeft % 60;
            timerElement.textContent = minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
        }, 1000);
    </script>
</body>

</html>
