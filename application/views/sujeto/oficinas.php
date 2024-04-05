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
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
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
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?php echo base_url("home/home_sujeto") ?>">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Tables</li>
                    </ol>
                    <!-- Botón para abrir el modal -->
                    <div class="d-flex justify-content-end mb-3">
                        <button type="button" class="btn btn-success " data-bs-toggle="modal"
                            data-bs-target="#modalAgregarOficina">
                            <i class="fas fa-plus-circle me-1"></i> Agregar Oficina
                        </button>
                    </div>
                    <!-- Modal para agregar oficina -->
                    <div class="modal fade" id="modalAgregarOficina" tabindex="-1"
                        aria-labelledby="modalAgregarOficinaLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalAgregarOficinaLabel">Agregar Oficina</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Formulario de agregar oficina -->
                                    <form class="row g-3" action="<?php echo base_url('vista/agregar_oficina'); ?>"
                                        method="post">
                                        <div class="form-group">
                                            <label for="selectSujeto">Sujeto obligado</label>
                                            <select class="form-control" id="selectSujeto" required>
                                                <option disabled>Selecciona una opción</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="selectUnidad">Unidad administrativa</label>
                                            <select class="form-control" id="selectUnidad" required>
                                                <option disabled>Selecciona una opción</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputNombre">Nombre</label>
                                            <input type="text" class="form-control" id="inputNombre"
                                            placeholder="Nombre completo" required>
                                            <small id="emailHelp" class="form-text text-muted">We'll never share your
                                                email with anyone else.</small>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputNombre" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" id="inputNombre" name="nombre">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputTipo" class="form-label">Tipo</label>
                                            <input type="text" class="form-control" id="inputTipo" name="tipo">
                                        </div>

                                        <!-- Agrega aquí los demás campos del formulario -->

                                        <!-- Botón "Guardar" dentro del formulario -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Fin del modal para agregar oficina -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Tipo</th>
                                        <th>Fecha actualizacion</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($oficinas as $oficina): ?>
                                        <tr>
                                            <td>
                                                <?php echo $oficina->id_oficina ?>
                                            </td>
                                            <td>
                                                <?php echo $oficina->nombre ?>
                                            </td>
                                            <td>
                                                <?php echo $oficina->tipo ?>
                                            </td>
                                            <td>
                                                <?php echo $oficina->fecha ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm rounded-circle me-2"><i
                                                        class="fas fa-edit"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm rounded-circle"
                                                    data-id_oficina="<?php echo $oficina->id_oficina ?>"><i
                                                        class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
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

    <script>
        $(document).ready(function () {
            $('#datatablesSimple').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
                }
            });
        });

        $(document).ready(function () {
            $('.btn-danger').click(function () {
                var id = $(this).data('id_oficina');

                $.ajax({
                    url: '<?php echo base_url('vista/eliminar_oficina/') ?>' + id,
                    type: 'POST',
                    success: function (result) {
                        // Recargar la página o hacer algo con el resultado
                        location.reload();
                    }
                });
            });
        });
    </script>

</body>