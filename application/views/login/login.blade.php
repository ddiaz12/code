@include('templates/header2')

<body class="sb-nav-fixed cuerpo-sujeto">

    <nav class="sb-topnav navbar navbar-expand navbar-custom" id="navbarhome">
        <!-- Navbar Brand-->
        <div class="div-escudo">
            <a class="navbar-brand" href="<?php echo base_url('home/home_sujeto'); ?>">
                <img src="<?php echo base_url('assets/'); ?>img/logo2.jpg" alt="Escudo del gobierno del estado" id="logo">
            </a>
        </div>
    </nav>

    <section class="div-contenido ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Registro Estatal de Regulaciones (RER)</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="wrap">

                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h5 class="mb-4">Correo Electronico</h5>
                                </div>
                            </div>
                            <form action="#" class="signin-form">
                                <div class="form-group mt-3">
                                    <input type="text" class="form-control" required>
                                    <label class="form-control-placeholder" for="username">sujetobligado@gob.mx</label>
                                </div>
                                <h5 class="mb-4">Contraseña</h5>
                                <div class="form-group">
                                    <input id="password-field" type="password" class="form-control" required>
                                    <label class="form-control-placeholder" for="password">********</label>
                                    <span toggle="#password-field"
                                        class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3"
                                        id="botonEnviar">Enviar</button>
                                </div>
                                <div class="form-group d-md-flex">
                                    <div class="w-50 text-left">
                                        <p class="text-center"><a data-toggle="tab"
                                                href="http://localhost/code/Usuarios/agregar_usuario"
                                                id="regis">Registrarse</a></p>
                                    </div>
                                    <div class="w-50 text-md-right">
                                        <a href="http://localhost/code/auth/forgot" id="forgot">¿Has olvidado tu
                                            contraseña?</a>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer class="py-4 bg-light mt-auto centrado">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted"></div>
                <div class="text-muted div-info">
                    <p>Contacto: Secretaria de Desarrollo Económico</p>
                    <p>Complejo Administrativo del Gobierno del Estado de Colima</p>
                    <p>Tercer Anillo Perf. S/N, El Diezmo, 28010 31231620000</p>
                </div>
                <div>
                    <a href="#"></a>
                    <a href="#"></a>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer -->

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>
