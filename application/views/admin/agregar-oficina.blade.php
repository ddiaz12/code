@layout('templates/master')
@section('titulo')
    Registro Estatal de Regulaciones
@endsection
@section('navbar')
    @include('templates/navbarAdmin')
@endsection
@section('menu')
    @include('templates/menuAdmin')
@endsection

@section('contenido')
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="<?php echo base_url('home/home_admin'); ?>"><i class="fas fa-home me-1"></i>Home</a>
        </li>
        <li class="breadcrumb-item"><a href="<?php echo base_url('oficinas'); ?>"><i class="fas fa-building me-1"></i>Oficinas</a>
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
                        <form class="row g-3" id="fromOficina">
                            <div class="form-group">
                                <label for="selectSujeto">Sujeto obligado<span class="text-danger">*</span></label>
                                <select class="form-control" id="selectSujeto" name="sujeto">
                                    <option disabled selected>Selecciona una opción</option>
                                    @foreach ($sujetos as $sujeto)
                                        <option value="{{ $sujeto->ID_sujeto }}">
                                            {{ $sujeto->nombre_sujeto }}
                                        </option>
                                    @endforeach
                                </select>
                                <small id="msg_sujeto" class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="selectUnidad">Unidad administrativa<span class="text-danger">*</span></label>
                                <select class="form-control" id="selectUnidad" name="unidad">
                                    <option disabled selected>Selecciona una opción</option>
                                    @foreach ($unidades as $unidad)
                                        <option value="{{ $unidad->ID_unidad }}">
                                            {{ $unidad->nombre }}</option>
                                    @endforeach
                                </select>
                                <small id="msg_unidad" class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="inputNombre">Nombre<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="inputNombre" name="inputNombre"
                                    placeholder="Nombre de la oficina">
                                <small id="msg_inputNombre" class="text-danger"></small>
                            </div>
                            <div class="col-md-6">
                                <label for="inputSiglas">Siglas<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="inputSiglas" name="siglas">
                                <small id="msg_siglas" class="text-danger"></small>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="selectVialidad">Tipo vialidad<span class="text-danger">*</span></label>
                                    <select class="form-control" id="selectVialidad" name="tipo_vialidad">
                                        <option disabled selected>Selecciona una opción</option>
                                        <?php foreach($vialidades as $vialidad): ?>
                                        <option value="<?php echo $vialidad->ID_Vialidades; ?>"><?php echo $vialidad->Vialidad; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <small id="msg_tipo_vialidad" class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="inputVialidad">Nombre vialidad<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="inputVialidad" name="inputVialidad">
                                <small id="msg_inputVialidad" class="text-danger"></small>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputNumInterior">Número interior</label>
                                    <input type="number" class="form-control" id="inputNumInterior" name="num_interior">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputNumExterior">Número exterior<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="inputNumExterior" name="num_exterior">
                                    <small id="msg_num_exterior" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="selectMunicipio">Municipio</label>
                                    <select class="form-control" id="selectMunicipio" name="municipio">
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
                                    <select class="form-control" id="selectLocalidad" name="localidad">
                                        <option disabled selected>Selecciona una opción</option>
                                        @foreach ($localidades as $localidad)
                                            <option value="<?php echo $localidad->ID_localidad; ?>" data-clave="<?php echo $localidad->clave; ?>">
                                                <?php echo $localidad->Localidades; ?>
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
                                    <select class="form-control" id="selectMunicipio" name="tipo_asentamiento">
                                        <option disabled>Selecciona una opción</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="selectAsentamiento">Nombre asentamiento</label>
                                    <select class="form-control" id="selectAsentamiento" name="nombre_asentamiento">
                                        <option disabled>Selecciona una opción</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputCP">C.P.<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="inputCP" name="codigo_postal"
                                        placeholder="Codigo postal">
                                    <small id="msg_codigo_postal" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputNumTel">Número de teléfono oficial<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="inputNumTel" name="inputNumTel"
                                        placeholder="(___) ___-____">
                                    <small id="msg_inputNumTel" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputExtension">Extensión</label>
                                    <input type="number" class="form-control" id="inputExtension" name="extension"
                                        required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope fa-2x"></i></span>
                                    </div>
                                    <input type="email" class="form-control" placeholder="Email" name="email">
                                </div>
                                <small id="msg_email" class="text-danger"></small>
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
                                <button type="button" class="btn btn-guardar" data-bs-toggle="modal"
                                    data-bs-target="#modalAgregarRangoHorario">
                                    Agregar Rango de horarios
                                </button>

                                <!-- Modal para Agregar Rango de Horarios -->
                                @include('modal/oficinaRangoHorarios')

                                <!-- Modal para Agregar Horarios -->
                                @include('modal/oficinaHorarios')
                            </div>

                            <div class="d-flex justify-content-end mb-3">
                                <a href="<?php echo base_url('oficinas'); ?>" class="btn btn-secondary me-2">Cancelar</a>
                                <button type="button" class="btn btn-success btn-guardar"
                                    onclick="enviarFormulario();">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        document.getElementById('selectLocalidad').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var clave = selectedOption.getAttribute('data-clave');
            document.getElementById('claveLocalidad').value = clave;
        });

        function enviarFormulario() {
            var sendData = $('#fromOficina').serializeArray();
            sendData.push({
                name: 'horarios',
                value: JSON.stringify(horarios)
            });

            $.ajax({
                url: '<?php echo base_url('oficinas/insertar'); ?>',
                type: 'POST',
                dataType: 'json',
                data: sendData,
                success: function(response) {

                    if (response.status == 'success') {
                        Swal.fire(
                            '¡Éxito!',
                            'La oficina ha sido agregada correctamente.',
                            'success'

                        ).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = response.redirect_url;
                            }
                        })
                    } else if (response.status == 'error') {
                        if (response.errores) {
                            $.each(response.errores, function(index, value) {
                                if ($("small#msg_" + index).length) {
                                    $("small#msg_" + index).html(value);
                                }
                            });
                            Swal.fire(
                                '¡Error!',
                                'Ha ocurrido un error al agregar la oficina. Por favor, inténtalo de nuevo.',
                                'error'
                            )
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    </script>
    <script src="<?php echo base_url('assets/'); ?>js/agregarHorario.js"></script>
    <script src="<?php echo base_url('assets/'); ?>js/tel.js"></script>
    <script src="<?php echo base_url('assets/'); ?>js/agregarRangoHorarios.js"></script>
@endsection