@include('templates/header3')

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
                                    <p id="titulo">¿Has olvidado tu contraseña?</p>
                                    <p id="texto">Captura tu correo electronico</p>
                                    <p id="texto">para restablecer tu cuenta:</p>
                                </div>
                            </div>

                            <form action="#" class="signin-form">
                                <div class="form-group mt-3">


                                </div>
                                <h5 class="mb-4">Correo Electronico</h5>
                                <div class="form-group mt-3">
                                    <input type="text" class="form-control" required>
                                    <label class="form-control-placeholder" for="password">sujetobligado@gob.mx</label>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3"
                                        id="botonEnviar">Enviar</button>
                                </div>
                                <p class="text-center"><a data-toggle="tab" href="#signup"
                                        id="regis">Registrarse</a></p>
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
