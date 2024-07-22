<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - Registro Estatal de Regulaciones</title>
    <link href= "<?php echo site_url('assets/css/styles.css'); ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo site_url('assets/css/base.css'); ?>">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    @yield('css')
</head>

<body class="cuerpo-login">
    <div id="layoutAuthentication" class="div-img">
        <div id="layoutAuthentication_content">
            <main>
            @yield('contenido')
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Registro Estatal de Regulaciones &middot; 2024 </div>
                        <div>
                            <a href="https://www.col.gob.mx/economico/contenido/NTM0ODA=">Aviso de privacidad</a>
                            &middot;
                            <a href="https://www.col.gob.mx/economico/contenido/NTM0ODA=">Términos &amp; Condiciones</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="<?php echo site_url('assets/js/scripts.js'); ?>"></script>
    @yield('js')
</body>

</html>