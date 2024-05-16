@include('templates/header')

<body class="sb-nav-fixed cuerpo-sujeto">
    <!-- Navbar -->
    @include('templates/navbar')
    <!-- Navbar -->

    <div id="layoutSidenav">
        <!-- Menu -->
        @include('templates/menu')
        <!-- Menu -->


        <div id="layoutSidenav_content">
            <main>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('home/home_sujeto'); ?>"><i class="fas fa-home me-1"></i>Home</a>
                    </li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url('oficinas/oficina'); ?>"><i
                                class="fas fa-building me-1"></i>Oficinas</a>
                    </li>
                    <li class="breadcrumb-item active"><i class="fa-solid fa-building-circle-check"></i>Agregar oficina
                    </li>
                </ol>
                <div class="container mt-5">
                    <div class="row justify-content-center div-formOficina">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header text-white">Agregar Oficina</div>
                                <div class="card-body">

                                    <!-- Formulario de agregar oficina -->
                                    <form class="row g-3" action="<?php echo base_url('ofincinas/insertar'); ?>" method="post">
                                        <div class="form-group">
                                            <label for="selectSujeto">Sujeto obligado<span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" id="selectSujeto" name="sujeto" required>
                                                <option disabled selected>Selecciona una opción</option>
                                                @foreach ($sujetos as $sujeto)
                                                    <option value="{{ $sujeto->ID_ofic }}">{{ $sujeto->Nombre_Sujeto }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="selectUnidad">Unidad administrativa<span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" id="selectUnidad" name="unidad" required>
                                                <option disabled selected>Selecciona una opción</option>
                                                @foreach ($sujetos as $sujeto)
                                                    <option value="{{ $sujeto->ID_ofic }}">{{ $sujeto->unidad_Administrativa }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputNombre">Nombre<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="inputNombre" name="nombre"
                                                placeholder="Nombre completo" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputSiglas">Siglas<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="inputSiglas" name="siglas"
                                                required>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="selectVialidad">Tipo vialidad<span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control" id="selectVialidad" name="tipo_vialidad"
                                                    required>
                                                    <option disabled selected>Selecciona una opción</option>
                                                    <?php foreach($vialidades as $vialidad): ?>
                                                    <option value="<?php echo $vialidad->ID_Vialidades; ?>"><?php echo $vialidad->Vialidad; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputVialidad">Nombre vialidad<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="inputVialidad"
                                                name="nombre_vialidad">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputNumInterior">Número interior</label>
                                                <input type="number" class="form-control" id="inputNumInterior"
                                                    name="num_interior">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputNumExterior">Número exterior<span
                                                        class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="inputNumExterior"
                                                    name="num_exterior" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="selectMunicipio">Municipio</label>
                                                <select class="form-control" id="selectMunicipio" name="municipio"
                                                    required>
                                                    <option disabled selected>Selecciona una opción</option>
                                                    @foreach ($municipios as $municipio)
                                                        <option value="<?php echo $municipio->ID_Municipio; ?>"><?php echo $municipio->Nombre_municipio; ?></option>
                                                    @endforeach;
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="selectLocalidad">Nombre localidad</label>
                                                <select class="form-control" id="selectLocalidad" name="localidad"
                                                    required>
                                                    <option disabled selected>Selecciona una opción</option>
                                                    @foreach ($localidades as $localidad)
                                                        <option value="<?php echo $localidad->ID_localidad; ?>"><?php echo $localidad->Localidades; ?>
                                                        </option>
                                                    @endforeach;
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="claveLocalidad">Clave localidad</label>
                                                <input type="number" class="form-control" id="claveLocalidad"
                                                    name="clave_localidad" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="selectMunicipio">Tipo asentamiento</label>
                                                <select class="form-control" id="selectMunicipio"
                                                    name="tipo_asentamiento">
                                                    <option disabled>Selecciona una opción</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="selectAsentamiento">Nombre asentamiento</label>
                                                <select class="form-control" id="selectAsentamiento"
                                                    name="nombre_asentamiento">
                                                    <option disabled>Selecciona una opción</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputCP">C.P.<span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="inputCP"
                                                    name="codigo_postal" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputNumTel">Número de teléfono oficial<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="inputNumTel"
                                                    name="inputNumTel" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputExtension">Extensión</label>
                                                <input type="number" class="form-control" id="inputExtension"
                                                    name="extension">
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="fas fa-envelope fa-2x"></i></span>
                                            </div>
                                            <input type="email" class="form-control" placeholder="Email"
                                                name="email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputNotas">Notas</label>
                                            <textarea class="form-control" id="inputNotas" name="notas"></textarea>
                                        </div>

                                        <!-- Tabla de Horarios de Atención -->
                                        <div class="form-group">
                                            <label>Horarios de Atención</label>
                                            <table class="table" id="tablaHorarios">
                                                <thead>
                                                    <tr>
                                                        <th>Día</th>
                                                        <th>Apertura</th>
                                                        <th>Cierre</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Aquí se mostrarán los horarios de atención -->
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Botón para Agregar Horarios -->
                                        <div class="form-group">
                                            <button type="button" class="btn btn-guardar" data-bs-toggle="modal"
                                                data-bs-target="#modalAgregarHorario">
                                                Agregar Horario
                                            </button>
                                        </div>

                                        <!-- Modal para Agregar Horarios -->
                                        <div class="modal fade" id="modalAgregarHorario" tabindex="-1"
                                            aria-labelledby="modalAgregarHorarioLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalAgregarHorarioLabel">Agregar
                                                            Horario de Atención</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Campos para seleccionar día, hora de apertura y cierre -->
                                                        <div class="mb-3">
                                                            <label for="selectDia" class="form-label">Día</label>
                                                            <select class="form-select" id="selectDia"
                                                                name="dia">
                                                                <option value="lunes">Lunes</option>
                                                                <option value="martes">Martes</option>
                                                                <option value="miercoles">Miércoles</option>
                                                                <option value="jueves">Jueves</option>
                                                                <option value="viernes">Viernes</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="inputApertura" class="form-label">Hora de
                                                                Apertura</label>
                                                            <input type="time" class="form-control"
                                                                id="inputApertura" name="apertura">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="inputCierre" class="form-label">Hora de
                                                                Cierre</label>
                                                            <input type="time" class="form-control"
                                                                id="inputCierre" name="cierre">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cerrar</button>
                                                        <button type="button" class="btn btn-guardar"
                                                            id="btnGuardarHorario">Guardar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end mb-3">
                                            <button type="submit"
                                                class="btn btn-success btn-guardar">Guardar</button>
                                            <a href="<?php echo base_url('oficinas/oficina'); ?>" class="btn btn-secondary me-2">Cancelar</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Obtener referencia a la tabla
                var tablaHorarios = document.getElementById('tablaHorarios');

                // Obtener referencia al botón de guardar dentro del modal
                var btnGuardarHorario = document.getElementById('btnGuardarHorario');

                // Agregar evento de clic al botón de guardar
                btnGuardarHorario.addEventListener('click', function() {
                    // Obtener valores de los campos del modal
                    var dia = document.getElementById('selectDia').value;
                    var apertura = document.getElementById('inputApertura').value;
                    var cierre = document.getElementById('inputCierre').value;

                    // Crear una nueva fila
                    var fila = tablaHorarios.insertRow();

                    // Crear celdas y agregar valores
                    var celdaDia = fila.insertCell();
                    celdaDia.textContent = dia;

                    var celdaApertura = fila.insertCell();
                    celdaApertura.textContent = apertura;

                    var celdaCierre = fila.insertCell();
                    celdaCierre.textContent = cierre;

                    // Crear celda para las acciones (eliminar)
                    var celdaAcciones = fila.insertCell();
                    var btnEliminar = document.createElement('button');
                    btnEliminar.textContent = 'Eliminar';
                    btnEliminar.classList.add('btn', 'btn-danger');
                    btnEliminar.addEventListener('click', function() {
                        // Eliminar la fila al hacer clic en el botón Eliminar
                        fila.remove();
                    });
                    celdaAcciones.appendChild(btnEliminar);

                    // Cerrar el modal
                    var modal = document.getElementById('modalAgregarHorario');
                    var modalBootstrap = bootstrap.Modal.getInstance(modal);
                    modalBootstrap.hide();
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#inputNumTel').on('input', function() {
                    let num = $(this).val().replace(/\D/g,
                        ''); // Elimina todos los caracteres que no sean dígitos
                    num = num.substring(0, 10); // Limita el número a 10 dígitos

                    // Formatea el número
                    let formattedNum = '';
                    for (let i = 0; i < num.length; i++) {
                        if (i === 0) {
                            formattedNum += '(' + num[i];
                        } else if (i === 3) {
                            formattedNum += ') ' + num[i];
                        } else if (i === 6) {
                            formattedNum += '-' + num[i];
                        } else {
                            formattedNum += num[i];
                        }
                    }

                    $(this).val(
                        formattedNum); // Actualiza el valor del campo de entrada con el número formateado
                });
            });
        </script>

        </main>
    </div>
</body>
