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
                                                <a href="http://localhost/code-main/RegulacionController/caracteristicas_reg"
                                                    class="custom-link">
                                                    <i class="fa-solid fa-list-check"></i>
                                                    <label for="image_1">Características de la Regulación</label>
                                                </a>
                                            </li>
                                            <p></p>
                                            <li>
                                                <a href="http://localhost/code-main/RegulacionController/mat_exentas"
                                                    class="custom-link">
                                                    <i class="fa-solid fa-table-list"></i>
                                                    <label for="image_2">Materias Exentas</label>
                                                </a>
                                            </li>
                                            <p></p>
                                            <li>
                                                <a href="http://localhost/code-main/RegulacionController/nat_regulaciones"
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
                                <div class="card-header text-white">Materias Exentas</div>
                                <div class="card-body align-content-center justify-content-center align-items-center">
                                    <div class="align-content-center justify-content-center align-items-center">
                                        <div
                                            class="d-flex align-content-center  justify-content-center align-items-center">
                                            <label for=" radioGroup">¿Existen materias que se exceptúan de la
                                                regulación?</label>
                                        </div>
                                        <div id="radioGroup"
                                            class="d-flex align-content-center  justify-content-center align-items-center">
                                            <input type="radio" id="si" name="opcion" value="si">
                                            <label for="si">Sí</label>

                                            <input type="radio" id="no" name="opcion" value="no">
                                            <label for="no">No</label>
                                        </div>
                                    </div>

                                    <div class="align-content-center d-flex justify-content-center align-items-center">
                                        <div id="checkboxes" style="display: none; flex-wrap: wrap; column-count: 3;">
                                            <!-- Generar 29 checkboxes -->
                                            <div>
                                                <input type="checkbox" id="checkbox1" name="checkbox1"
                                                    value="checkbox1">
                                                <label for="checkbox1">Fiscal</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="checkbox2" name="checkbox2"
                                                    value="checkbox2">
                                                <label for="checkbox2">Aduanera</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="checkbox3" name="checkbox3"
                                                    value="checkbox3">
                                                <label for="checkbox3">Armas de fuego y explosivos</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="checkbox4" name="checkbox4"
                                                    value="checkbox4">
                                                <label for="checkbox4">Comercio exterior</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="checkbox5" name="checkbox5"
                                                    value="checkbox5">
                                                <label for="checkbox5">Constatar medidas de protección civil</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="checkbox6" name="checkbox6"
                                                    value="checkbox6">
                                                <label for="checkbox6">Derechos e intereses del consumidor</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="checkbox7" name="checkbox7"
                                                    value="checkbox7">
                                                <label for="checkbox7">Infraestructura y/o construcción</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="checkbox8" name="checkbox8"
                                                    value="checkbox8">
                                                <label for="checkbox8">Medio ambiente</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="checkbox9" name="checkbox9"
                                                    value="checkbox9">
                                                <label for="checkbox9">Operaciones con recursos de procedencia
                                                    ilícita</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="checkbox10" name="checkbox10"
                                                    value="checkbox10">
                                                <label for="checkbox10">Otra</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="checkbox11" name="checkbox11"
                                                    value="checkbox11">
                                                <label for="checkbox11">Programas sociales</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="checkbox12" name="checkbox12"
                                                    value="checkbox12">
                                                <label for="checkbox12">Protección contra riesgos sanitarios</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="checkbox13" name="checkbox13"
                                                    value="checkbox13">
                                                <label for="checkbox13">Proteger la sanidad y la inocuidad
                                                    agroalimentaria,
                                                    animal y vegetal</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="checkbox14" name="checkbox14"
                                                    value="checkbox14">
                                                <label for="checkbox14">Recursos naturales</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="checkbox15" name="checkbox15"
                                                    value="checkbox15">
                                                <label for="checkbox15">Resguardar la seguridad Nacional</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="checkbox16" name="checkbox16"
                                                    value="checkbox16">
                                                <label for="checkbox16">Revisión de contratos petroleros (art. 37-B-VII
                                                    y 63
                                                    LISH)</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="checkbox17" name="checkbox17"
                                                    value="checkbox17">
                                                <label for="checkbox17">Salud humana</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="checkbox18" name="checkbox18"
                                                    value="checkbox18">
                                                <label for="checkbox18">Salud pública, medicamentos, asistencia
                                                    sanitaria
                                                    y/o sanidad</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="checkbox19" name="checkbox19"
                                                    value="checkbox19">
                                                <label for="checkbox19">Sector financiero</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="checkbox20" name="checkbox20"
                                                    value="checkbox20">
                                                <label for="checkbox20">Seguridad alimentaria</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="checkbox21" name="checkbox21"
                                                    value="checkbox21">
                                                <label for="checkbox21">Seguridad de la población</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="checkbox22" name="checkbox22"
                                                    value="checkbox22">
                                                <label for="checkbox22">Seguridad de los productos no alimentarios y
                                                    protección del consumidor</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="checkbox23" name="checkbox23"
                                                    value="checkbox23">
                                                <label for="checkbox23">Seguridad nuclear</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="checkbox24" name="checkbox24"
                                                    value="checkbox24">
                                                <label for="checkbox24">Seguridad social</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="checkbox25" name="checkbox25"
                                                    value="checkbox25">
                                                <label for="checkbox25">Seguridad, protección y/ salud laboral</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="checkbox26" name="checkbox26"
                                                    value="checkbox26">
                                                <label for="checkbox26">Trabajo</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="checkbox27" name="checkbox27"
                                                    value="checkbox27">
                                                <label for="checkbox27">Transporte</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" id="checkbox28" name="checkbox28"
                                                    value="checkbox28">
                                                <label for="checkbox28">Turismo</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mb-3">
                                    <button type="submit" class="btn btn-success btn-guardar">Guardar</button>
                                    <a href="<?php echo base_url('oficinas/oficina'); ?>"
                                        class="btn btn-secondary me-2">Cancelar</a>
                                </div>

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