<body class="sb-nav-fixed cuerpo-sujeto">

    <nav class="sb-topnav navbar navbar-expand navbar-custom" id="navbarhome">
        <!-- Navbar Brand-->
        <div class="div-escudo">
            <a class="navbar-brand" href="<?php echo base_url("home/home_sujeto") ?>">
                <img src="<?php echo base_url("assets/") ?>img/logo2.jpg" alt="Escudo del gobierno del estado"
                    id="logo">
            </a>
        </div>
        <!-- Navbar Brand-->

        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Sidebar Toggle-->

        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

        </form>
        <!-- Navbar Search-->

        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fa-solid fa-user fa-2x"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul>
        <!-- Navbar-->
    </nav>

    <div id="layoutSidenav">
        <!-- Menu -->
        <div id="layoutSidenav_nav" class="div-menu">
            <nav class="sb-sidenav sb-sidenav-white" id="sidenavAccordion">
                <div class="sb-sidenav-menu menu-custom">
                    <div class="nav">
                        <a class="nav-link" href="<?php echo base_url("home/home_sujeto") ?>">
                            <div class="sb-nav-link-icon div-home"><i class="fa-solid fa-house icon-home"></i></div>
                        </a>
                        <a class="nav-link" href="charts.html">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-scale-balanced icon-balanced"></i></div>
                        </a>
                        <a class="nav-link" href="tables.html">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-chalkboard-user icon-user"></i></div>
                        </a>
                        <a class="nav-link" href="tables.html">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-gear icon-gear"></i></div>
                        </a>
                        <a class="nav-link" href="tables.html">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-circle-info icon-info"></i></div>
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>
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
                                    <a href="<?php echo base_url("vista/oficina") ?>"
                                        class="btn btn-primary btn-oficina">administrar</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            <!-- Footer -->
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2023</div>
                        <div class="text-muted div-info">Contacto: Secretaria de Desarrollo Económico
                            Complejo Administrativo del Gobierno del Estado de Colima
                            Tercer Anillo Perf. S/N, El Diezmo, 28010 31231620000
                        </div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- Footer -->
        </div>
        <!-- Contenido -->
    </div>
</body>