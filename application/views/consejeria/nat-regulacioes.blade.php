@include('templates/header')

<body class="sb-nav-fixed cuerpo-sujeto">
    <div id="layoutSidenav">
        <!-- Menu -->
        @include('templates/menu')
        <!-- Menu -->
    </div>

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

    <div id="layoutSidenav_content">
        <main>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="<?php echo base_url('home/home_sujeto'); ?>"><i
                            class="fas fa-home me-1"></i>Home</a>
                </li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('oficinas/oficina'); ?>"><i
                            class="fas fa-building me-1"></i>Oficinas</a>
                </li>
                <li class="breadcrumb-item active"><i class="fa-solid fa-building-circle-check"></i>Agregar oficina
                </li>
            </ol>
            <div class="container mt-5">
                <div class="row justify-content-center div-formOficina">
                    <div class="row d-flex d-flex align-items-stretch">
                        <div class="col-md-3 p-0 d-flex flex-column">
                            <!-- New card -->
                            <style>
                            .custom-link {
                                color: black;
                                cursor: pointer !important;
                                font-size: 19px;
                                /* Adjust as needed */
                            }

                            .custom-link:hover {
                                color: gray;
                                text-decoration: none;
                            }

                            .custom-link i {
                                font-size: 24px;
                                /* Adjust as needed */
                            }
                            </style>
                            <div class="card flex-grow-1">
                                <div class="card" style="border: none;">
                                    <div class="card-body" style="border: none;">
                                        <ul class="list-unstyled">
                                            <li>
                                                <a href="http://localhost/code-main/home/caracteristicas_reg"
                                                    class="custom-link">
                                                    <i class="fa-solid fa-list-check"></i>
                                                    <label for="image_1">Características de la Regulación</label>
                                                </a>
                                            </li>
                                            <p></p>
                                            <li>
                                                <a href="http://localhost/code-main/home/mat_exentas"
                                                    class="custom-link">
                                                    <i class="fa-solid fa-table-list"></i>
                                                    <label for="image_2">Materias Exentas</label>
                                                </a>
                                            </li>
                                            <p></p>
                                            <li>
                                                <a href="http://localhost/code-main/home/nat_regulaciones"
                                                    class="custom-link">
                                                    <i class="fa-solid fa-book"></i>
                                                    <label for="image_3">Naturaleza de la Regulación</label>
                                                </a>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 p-0">
                            <div class="card">
                                <div class="card-header text-white">Naturaleza de la regulación</div>
                                <div class="card-body d-flex flex-column justify-content-center">
                                    <div class="row justify-content-center">
                                        <label for="radioGroup">¿La regulación está asociada a una actividad
                                            económica?</label>
                                        <div id="radioGroup">
                                            <input type="radio" id="si" name="opcion" value="si">
                                            <label for="si">Sí</label>
                                            <input type="radio" id="no" name="opcion" value="no">
                                            <label for="no">No</label>
                                        </div>
                                    </div>
                                    <div class="form-group" id="inputs" style="display: none;">
                                        <!-- Generar 5 inputs -->
                                        <div class=" form-group row justify-content-center">
                                            <label for="input1">Sector<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="input1" name="input1"
                                                placeholder="Selecciona una opcion" required>
                                        </div>
                                        <div class="row justify-content-center">
                                            <label for="input2">Subsector<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="input2" name="input2"
                                                placeholder="Selecciona una opcion" required>
                                        </div>
                                        <div class="row justify-content-center">
                                            <label for="input3">Rama<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="input3" name="input3"
                                                placeholder="Selecciona una opcion" required>
                                        </div>
                                        <div class="row justify-content-center">
                                            <label for="input4">Subrama<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="input4" name="input4"
                                                placeholder="Selecciona una opcion" required>
                                        </div>
                                        <div class="row justify-content-center">
                                            <label for="input5">Clase<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="input5" name="input5"
                                                placeholder="Selecciona una opcion" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputVinculadas">Regulaciones vinculadas o derivadas de esta
                                            regulación<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="inputVinculadas" name="vinculadas"
                                            placeholder="Regulaciones Vinculadas" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEnlace">Enlace oficial de la regulación<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="inputEnlace" name="EnlaceOficial"
                                            placeholder="http://" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="radioGroup">Tipo de documento:</label>
                                        <div id="radioGroup">
                                            <input type="radio" id="documento" name="opcion" value="documento">
                                            <label for="documento">Documento</label>
                                            <input type="radio" id="liga" name="opcion" value="liga">
                                            <label for="liga">Liga de Documento</label>
                                        </div>
                                    </div>
                                    <div id="fileInput" class="form-group" style="display: none;">
                                        <label for="file">Subir Documento:</label>
                                        <input type="file" class="form-control-file" id="file">
                                    </div>
                                    <div id="urlInput" class="form-group" style="display: none;">
                                        <label for="url">URL del Documento:</label>
                                        <input type="text" class="form-control" id="url" placeholder="http://">
                                    </div>

                                    <!-- jQuery -->
                                    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

                                    <script>
                                    $(document).ready(function() {
                                        $('input[type=radio][name=opcion]').change(function() {
                                            if (this.value == 'documento') {
                                                $('#fileInput').show();
                                                $('#urlInput').hide();
                                            } else if (this.value == 'liga') {
                                                $('#urlInput').show();
                                                $('#fileInput').hide();
                                            }
                                        });
                                    });
                                    </script>
                                </div>

                                <!-- jQuery -->
                                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

                                <script>
                                $(document).ready(function() {
                                    $('input[type=radio][name=opcion]').change(function() {
                                        if (this.value == 'si') {
                                            $('#inputs').show();
                                        } else if (this.value == 'no') {
                                            $('#inputs').hide();
                                        }
                                    });
                                });
                                </script>
                                <div class="d-flex justify-content-end mb-3">
                                    <button type="submit" class="btn btn-success btn-guardar">Guardar</button>
                                    <a href="<?php echo base_url('oficinas/oficina'); ?>"
                                        class="btn btn-secondary me-2">Cancelar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </main>
        <div id="layoutSidenav_content">
        </div>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

        <script>
        $(document).ready(function() {
            $('input[type=radio][name=opcion]').change(function() {
                if (this.value == 'si') {
                    $('#checkboxes').show();
                } else if (this.value == 'no') {
                    $('#checkboxes').hide();
                }
            });
        });
        </script>
    </div>
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