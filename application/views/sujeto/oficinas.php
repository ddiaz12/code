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
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownBalanced"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-scale-balanced icon-balanced"></i>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownBalanced">
                                <h6 class="dropdown-header">Regulaciones</h6>
                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-inbox icon-inbox"></i> Mi
                                        buzon</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-paper-plane icon-sent"></i>
                                        Enviadas</a></li>
                                <li><a class="dropdown-item" href="#"><i
                                            class="fa-solid fa-bullhorn icon-published"></i> Publicadas</a></li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownUser"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-chalkboard-user icon-user"></i>
                                </div>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownUser">
                                <h6 class="dropdown-header">Modulo de capacitaciones</h6>
                                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-book icon-cursos"></i>
                                        Cursos</a></li>
                            </ul>
                        </div>
                        <a class="nav-link" href="#">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-gear icon-gear"></i></div>
                        </a>
                        <a class="nav-link" href="#">
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
                    <!-- Botón para abrir otra vista -->
                    <div class="d-flex justify-content-end mb-3">
                        <a href="<?php echo base_url('oficinas/agregar_oficina'); ?>" class="btn btn-primary">
                            <i class="fas fa-eye me-1"></i> Ver Otra Vista
                        </a>
                    </div>
                    <!-- Modal para agregar oficina -->
                    <div class="modal fade" id="modalAgregarOficina" tabindex="-1"
                        aria-labelledby="modalAgregarOficinaLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalAgregarOficinaLabel">Agregar Oficina</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Formulario de agregar oficina -->
                                    <form class="row g-3" action="<?php echo base_url('oficinas/agregar'); ?>"
                                        method="post">
                                        <div class="form-group">
                                            <label for="selectSujeto">Sujeto obligado<span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" id="selectSujeto" required>
                                                <option disabled>Selecciona una opción</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="selectUnidad">Unidad administrativa<span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" id="selectUnidad" required>
                                                <option disabled>Selecciona una opción</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputNombre">Nombre<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="inputNombre"
                                                placeholder="Nombre completo" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputSiglas">Siglas<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="inputSiglas" required>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="selectVialidad">Tipo vialidad<span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control" id="selectVialidad" required>
                                                    <option disabled>Selecciona una opción</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputVialidad">Nombre vialidad<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="inputVialidad">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputNumInterior">Número interior</label>
                                                <input type="number" class="form-control" id="inputNumInterior"
                                                    name="Num_interior">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputNumExterior">Número exterior<span
                                                        class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="inputNumExterior"
                                                    name="Num_Exterior" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="selectMunicipio">Municipio<span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control" id="selectMunicipio" required>
                                                    <option disabled>Selecciona una opción</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="selectLocalidad">Nombre localidad<span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control" id="selectLocalidad" required>
                                                    <option disabled>Selecciona una opción</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="claveLocalidad">Clave localidad<span
                                                        class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="claveLocalidad"
                                                    name="Num_Exterior" readonly required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="selectMunicipio">Tipo asentamiento<span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control" id="selectMunicipio" required>
                                                    <option disabled>Selecciona una opción</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="selectAsentamiento">Nombre asentamiento<span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control" id="selectAsentamiento" required>
                                                    <option disabled>Selecciona una opción</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputCP">C.P.<span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="inputCP" name="C.P."
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputNumTel">Número de teléfono oficial<span
                                                    class="text-danger">*</span></label>
                                            <input type="number" class="form-control" id="inputNumTel"
                                                name="NumTel_Oficial" required>
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputExtension">Extensión</label>
                                            <input type="number" class="form-control" id="inputExtension"
                                                name="Extension" required>
                                        </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail">Correo electrónico</label>
                                            <input type="email" class="form-control" id="inputEmail" name="Correo_Elec"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputNotas">Notas</label>
                                            <textarea class="form-control" id="inputNotas" name="Notas"></textarea>
                                        </div>
                                        
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
                    url: '<?php echo base_url('oficinas/eliminar_oficina/') ?>' + id,
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