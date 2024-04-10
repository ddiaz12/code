@include('templates/header')
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
                    <h1 class="mt-4 titulo-menu">Registro Estatal de Regulaciones (RER)</h1>

                    <div class="row">
                        <div class="col-sm-6 mb-3 mb-sm-0 div-card">
                            <div class="card h-100 d-flex align-items-center card-regulacion">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Regulaciones</h5>
                                    <p class="card-text text-regulacion">Administra cualquier normativa de caracter
                                        general.</p>
                                    <a href="#" class="btn btn-primary btn-regulacion">administrar</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 div-card">
                            <div class="card h-100 d-flex align-items-center card-oficina">
                                <div class="card-body card-oficinas text-center">
                                    <h5 class="card-title">Oficinas</h5>
                                    <p class="card-text">Administrar usuarios de la plataforma del Catálogo Nacional de
                                        Trámites y Servicios.</p>
                                    <a href="<?php echo base_url("oficinas/oficina") ?>"
                                        class="btn btn-primary btn-oficina">administrar</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            <!-- Footer -->
            @include('templates/footer')
            <!-- Footer -->
        </div>
        <!-- Contenido -->
    </div>
</body>