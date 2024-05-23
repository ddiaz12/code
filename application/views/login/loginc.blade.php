@include('templates/header2')

<body class="sb-nav-fixed cuerpo-sujeto">

    <!-- Navbar Brand-->

    <div id="layoutSidenav_content" class="div-img">
        <main>
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
                                            <label class="form-control-placeholder"
                                                for="username">sujetobligado@gob.mx</label>
                                        </div>
                                        <h5 class="mb-4">Contraseña</h5>
                                        <div class="form-group">
                                            <input id="password-field" type="password" class="form-control" required>
                                            <label class="form-control-placeholder" for="password">********</label>
                                            <span toggle="#password-field"
                                                class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit"
                                                class="form-control btn btn-primary rounded submit px-3"
                                                id="botonEnviar">Enviar</button>
                                        </div>
                                        <div class="form-group d-md-flex">
                                            <div class="w-50 text-left">
                                                <p class="text-center"><a data-toggle="tab"
                                                        href="http://localhost/code/Usuarios/agregar_usuario"
                                                        id="regis">Registrarse</a></p>
                                            </div>
                                            <div class="w-50 text-md-right">
                                                <a href="http://localhost/code/auth/forgot" id="forgot">¿Has olvidado
                                                    tu
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
            @include('templates/footer')
        </main>
    </div>
    <!-- Footer -->

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>
