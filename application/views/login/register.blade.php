@include('templates/header2')
	<body class="sb-nav-fixed cuerpo-sujeto">

	<nav class="sb-topnav navbar navbar-expand navbar-custom" id="navbarhome">
        <!-- Navbar Brand-->
        <div class="div-escudo">
            <a class="navbar-brand" href="<?php echo base_url("home/home_sujeto") ?>">
                <img src="<?php echo base_url("assets/") ?>img/logo2.jpg" alt="Escudo del gobierno del estado"
                    id="logo">
            </a>
        </div>
    </nav>

    
	<div class="card-body div-contenido">
        <h2 class="heading-section titulo">Registro Estatal de Regulaciones (RER)</h2>
                                <!-- Formulario de agregar oficina -->
                                <form class="row g-3 " action="<?php echo base_url('ofincinas/insertar'); ?>" method="post">
                                    <div class="form-group">
                                        <label for="selectSujeto">Sujeto Obligado<span
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
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i
                                                    class="fas fa-envelope fa-2x"></i></span>
                                        </div>
                                        <input type="email" class="form-control" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputNotas">Notas</label>
                                        <textarea class="form-control" id="inputNotas" name="Notas"></textarea>
                                    </div>
                                </form>
    </div>

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

