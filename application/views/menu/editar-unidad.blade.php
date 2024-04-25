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
                    <li class="breadcrumb-item"><a href="<?php echo base_url('menu/menu_unidades'); ?>"><i class="fas fa-cogs me-1"></i>Unidades
                            administrativas</a></li>
                    <li class="breadcrumb-item active"><i class="fa-solid fa-pencil-alt"></i>Editar unidad
                        administrativa
                    </li>
                </ol>
                <div class="container mt-5">
                    <div class="row justify-content-center div-formOficina">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header text-white">Editar unidad
                                    administrativa</div>
                                <div class="card-body">

                                    <!-- Formulario de editar unidad administrativa -->
                                    <form class="row g-3" id="formUnidad">
                                        <input type="hidden" name="id_unidad" value="{{ $unidad->ID_unidad }}">
                                        <div class="form-group">
                                            <label for="selectSujeto">Sujeto obligado<span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control" id="selectSujeto" name="sujeto" required>
                                                <option disabled selected>Selecciona una opción</option>
                                                @foreach ($sujetos as $sujeto)
                                                    <option value="{{ $sujeto->ID_sujeto }}"
                                                        {{ $sujeto->ID_sujeto == $unidad->ID_sujeto ? 'selected' : '' }}>
                                                        {{ $sujeto->nombre_sujeto }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputNombre">Nombre<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="inputNombre" name="nombre"
                                                placeholder="Nombre completo" value="{{ $unidad->nombre }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputSiglas">Siglas<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="inputSiglas" name="siglas"
                                                value="{{ $unidad->siglas }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="selectVialidad">Tipo vialidad<span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control" id="selectVialidad" name="tipo_vialidad"
                                                    required>
                                                    <option disabled selected>Selecciona una opción</option>
                                                    @foreach ($vialidades as $vialidad)
                                                        <option value="{{ $vialidad->ID_Vialidades }}">
                                                            {{ $vialidad->Vialidad }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputVialidad">Nombre vialidad<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="inputVialidad"
                                                name="nombre_vialidad" value="{{ $unidad->nombre_vialidad }}">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputNumInterior">Número interior</label>
                                                <input type="number" class="form-control" id="inputNumInterior"
                                                    name="num_interior" value="{{ $unidad->Num_interior }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputNumExterior">Número exterior<span
                                                        class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="inputNumExterior"
                                                    name="num_exterior" value="{{ $unidad->Num_Exterior }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="selectMunicipio">Municipio</label>
                                                <select class="form-control" id="selectMunicipio" name="municipio"
                                                    required>
                                                    <option disabled selected>Selecciona una opción</option>
                                                    @foreach ($municipios as $municipio)
                                                        <option value="{{ $municipio->ID_Municipio }}">
                                                            {{ $municipio->Nombre_municipio }}</option>
                                                    @endforeach
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
                                                        <option value="{{ $localidad->ID_localidad }}">
                                                            {{ $localidad->Localidades }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="claveLocalidad">Clave localidad</label>
                                                <input type="number" class="form-control" id="claveLocalidad"
                                                    name="clave_localidad" value="{{ $unidad->clave_localidad }}"
                                                    readonly>
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
                                                    name="codigo_postal" value="{{ $unidad->c_p }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputNumTel">Número de teléfono oficial<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="inputNumTel"
                                                    name="inputNumTel" value="{{ $unidad->NumTel_Oficial }}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputExtension">Extensión</label>
                                                <input type="number" class="form-control" id="inputExtension"
                                                    name="extension" value="{{ $unidad->extension }}">
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="fas fa-envelope fa-2x"></i></span>
                                            </div>
                                            <input type="email" class="form-control" placeholder="Email"
                                                name="email" value="{{ $unidad->Correo_Elec }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputNotas">Notas</label>
                                            <textarea class="form-control" id="inputNotas" name="notas" value="{{ $unidad->Notas }}"></textarea>
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
                                                    @foreach ($horarios as $horario)
                                                        <tr>
                                                            <td>{{ $horario->dia }}</td>
                                                            <td>{{ $horario->apertura }}</td>
                                                            <td>{{ $horario->cierre }}</td>
                                                            <td>
                                                                <!-- Botón para eliminar la fila -->
                                                                <button type="button" class="btn btn-danger eliminar"
                                                                    data-id="{{ $horario->ID_horarios }}">Eliminar</button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
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
                                                            <select class="form-select" id="dia"
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
                                                            <input type="time" class="form-control" id="apertura"
                                                                name="apertura" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="inputCierre" class="form-label">Hora de
                                                                Cierre</label>
                                                            <input type="time" class="form-control" id="cierre"
                                                                name="cierre" required>
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
                                            <button type="button" onclick="enviarFormulario();"
                                                class="btn btn-success btn-guardar">Actualizar</button>
                                            <a href="<?php echo base_url('menu/menu_unidades'); ?>" class="btn btn-secondary me-2">Cancelar</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <script>
            var horarios = [];
            var horariosEliminados = [];

            document.addEventListener('DOMContentLoaded', function() {
                var tablaHorarios = document.getElementById('tablaHorarios');
                var btnGuardarHorario = document.getElementById('btnGuardarHorario');

                btnGuardarHorario.addEventListener('click', function() {
                    var dia = document.getElementById('dia').value;
                    var apertura = document.getElementById('apertura').value;
                    var cierre = document.getElementById('cierre').value;

                    let horario = {
                        dia: dia,
                        apertura: apertura,
                        cierre: cierre
                    };

                    horarios.push(horario);

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
                        fila.remove();
                    });
                    celdaAcciones.appendChild(btnEliminar);

                    // Cerrar el modal
                    var modal = document.getElementById('modalAgregarHorario');
                    var modalBootstrap = bootstrap.Modal.getInstance(modal);
                    modalBootstrap.hide();
                });
            });

            $('#tablaHorarios').on('click', '.eliminar', function() {
                var idHorario = $(this).data('id');
                horariosEliminados.push(idHorario);
                $(this).closest('tr').remove();
            });

            function enviarFormulario() {
                var sendData = $('#formUnidad').serializeArray();
                $.ajax({
                    url: '<?php echo base_url('menu/actualizar_unidad'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'json1': sendData,
                        'json2': horarios,
                        'json3': horariosEliminados
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            window.location.href = '<?php echo base_url('menu/menu_unidades'); ?>';
                        } else {
                            console.error('Error al procesar la solicitud.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        </script>
        <script src="<?php echo base_url('assets/'); ?>js/tel.js"></script>

        </main>
    </div>
</body>
