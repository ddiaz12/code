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
    <ol class="breadcrumb mb-4 mt-5">
        <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>"><i class="fas fa-home me-1"></i>Inicio</a>
        </li>
        <li class="breadcrumb-item"><a href="<?php echo base_url('oficinas'); ?>"><i
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
                        <form class="row g-3" id="fromOficina">
                            <div class="form-group">
                                <label for="selectSujeto">Sujeto Obligado<span class="text-danger">*</span></label>
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
                                    <!-- @foreach ($unidades as $unidad)
                                        <option value="{{ $unidad->ID_unidad }}">
                                            {{ $unidad->nombre }}
                                        </option>
                                    @endforeach -->
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
                                        <?php foreach ($vialidades as $vialidad): ?>
                                        <option value="<?php    echo $vialidad->ID_Vialidades; ?>">
                                            <?php    echo $vialidad->Vialidad; ?>
                                        </option>
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
                                    <input type="text" class="form-control" id="inputNumExterior" name="num_exterior"
                                        maxlength="4">
                                    <small id="msg_num_exterior" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="selectMunicipio">Municipio</label>
                                    <select class="form-control" id="selectMunicipio" name="municipio">
                                        <option disabled selected>Selecciona una opción</option>
                                        @foreach ($municipios as $municipio)
                                            <option value="<?php    echo $municipio->ID_Municipio; ?>" <?php    echo $municipio->Nombre_municipio == 'Colima' ? 'selected' : '' ?>>
                                                <?php    echo $municipio->Nombre_municipio; ?>
                                            </option>
                                        @endforeach;
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="selectLocalidad">Nombre localidad<span class="text-danger">*</span></label>
                                    <select class="form-control" id="selectLocalidad" name="localidad" required>
                                        <option disabled selected>Selecciona una opción</option>
                                        @foreach ($localidades as $localidad)
                                            <option value="<?php    echo $localidad->ID_localidad; ?>"
                                                data-clave="<?php    echo $localidad->clave; ?>">
                                                <?php    echo $localidad->Localidades; ?>
                                            </option>
                                        @endforeach;
                                    </select>
                                </div>
                                <small id="msg_localidad" class="text-danger"></small>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="claveLocalidad">Clave localidad</label>
                                    <input type="text" class="form-control" id="claveLocalidad" name="clave_localidad"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="selectTipoAsentamiento">Tipo asentamiento<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" id="selectTipoAsentamiento" name="tipo_asentamiento">
                                        <option disabled selected>Selecciona una opción</option>
                                    </select>
                                </div>
                                <small id="msg_tipo_asentamiento" class="text-danger"></small>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="selectAsentamiento">Nombre asentamiento<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" id="selectAsentamiento" name="nombre_asentamiento">
                                        <option disabled selected>Selecciona una opción</option>
                                        @foreach ($asentamientos as $asentamiento)
                                            <option value="{{ $asentamiento->ID_nAsentamiento }}"
                                                data-codigo-postal="{{ $asentamiento->CP }}">
                                                {{ $asentamiento->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <small id="msg_nombre_asentamiento" class="text-danger"></small>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputCP">C.P.</label>
                                    <input type="number" class="form-control" id="inputCP" name="codigo_postal"
                                        placeholder="Código postal" readonly>
                                    <small id="msg_codigo_postal" class="text-danger"></small>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Número de teléfono oficial<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="(000) 000-0000">
                                    <small id="msg_phone" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ext">Extensión</label>
                                    <input type="text" class="form-control" id="ext" name="ext" placeholder="Extension">
                                    <small id="msg_ext" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">Correo electrónico<span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope fa-2x"></i></span>
                                    </div>
                                    <input type="email" class="form-control" placeholder="Correo electrónico" name="email">
                                </div>
                                <small id="msg_email" class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label for="inputNotas">Notas</label>
                                <textarea class="form-control" id="inputNotas" name="notas"></textarea>
                            </div>

                            <!-- Tabla de Horarios de Atención -->
                            <div class="form-group">
                                <label>Horarios de atención</label>
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
                                    Agregar horario
                                </button>
                                <button type="button" class="btn btn-guardar" data-bs-toggle="modal"
                                    data-bs-target="#modalAgregarRangoHorario">
                                    Agregar rango de horarios
                                </button>

                                <!-- Modal para Agregar Rango de Horarios -->
                                @include('modal/oficinaRangoHorarios')

                                <!-- Modal para Agregar Horarios -->
                                @include('modal/oficinaHorarios')
                            </div>

                            <div class="alert alert-danger" role="alert" id="msg_error_horarios" style="display: none;">
                            </div>

                            <div class="d-flex justify-content-end mb-3">
                                <button type="button" class="btn btn-secondary me-2"
                                    onclick="confirmarCancelar();">Cancelar</button>
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
    <script src="<?php echo base_url('assets/js/apiAsentamientos.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/getElementChange.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/agregarHorario.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/agregarRangoHorarios.js'); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#phone').mask('(000) 000-0000');
            $('#ext').mask('000000');

            // Aplicar máscara al campo de número exterior
            $('#inputNumExterior').mask('Z', {
                translation: {
                    'Z': {
                        pattern: /[1-9sSnN\/]/, // Acepta números, "s", "S", "n", "N" y "/"
                        recursive: true
                    }
                }
            });
        });

        // Manejar el cambio en el campo de selección de sujetos obligados
        $('#selectSujeto').change(function() {
            var sujeto_id = $(this).val();
            if (sujeto_id) {
                $.ajax({
                    url: '<?php echo base_url('oficinas/get_unidades_by_sujeto/'); ?>' + sujeto_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#selectUnidad').empty();
                        $('#selectUnidad').append('<option disabled selected>Selecciona una opción</option>');
                        $.each(data, function(key, value) {
                            $('#selectUnidad').append('<option value="' + value.ID_unidad + '">' + value.nombre + '</option>');
                        });
                    }
                });
            } else {
                $('#selectUnidad').empty();
                $('#selectUnidad').append('<option disabled selected>Selecciona una opción</option>');
            }
        });
    </script>
    <script>
        function enviarFormulario() {
            var sendData = $('#fromOficina').serializeArray();
            mostrarPantallaDeCarga();
            sendData.push({
                name: 'horarios',
                value: JSON.stringify(horarios)
            });

            $.ajax({
                url: '<?php echo base_url('oficinas/insertar'); ?>',
                type: 'POST',
                dataType: 'json',
                data: sendData,
                success: function (response) {
                    ocultarPantallaDeCarga();
                    if (response.status == 'success') {
                        Swal.fire(
                            '¡Exito!',
                            'La oficina ha sido agregada correctamente.',
                            'success'

                        ).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = response.redirect_url;
                            }
                        })
                    } else if (response.status == 'error') {
                        $('#msg_error').hide();
                        // Mostrar el mensaje de error específico para los horarios
                        if (response.message) {
                            $('#msg_error_horarios').text(response.message);
                        } else {
                            $('#msg_error_horarios').text(
                                'Ha ocurrido un error al intentar guardar. Por favor, verifica los campos e inténtalo de nuevo.'
                            );
                        }
                        $('#msg_error_horarios').show();
                        if (response.errores) {
                            $.each(response.errores, function (index, value) {
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
                error: function (xhr, status, error) {
                    ocultarPantallaDeCarga();
                    console.error(error);
                }
            });
        }

        function confirmarCancelar() {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Los cambios no guardados se perderán",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, cancelar',
                cancelButtonText: 'No, continuar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '<?php echo base_url('oficinas'); ?>';
                }
            })
        }

        $(document).ready(function () {
            // Validación en tiempo real
            $('#fromOficina input, #fromOficina select').on('input change', function () {
                var $input = $(this);
                var $errorMsg = $("#msg_" + $input.attr('id'));
                if ($input.val() !== '') {
                    $errorMsg.html('');
                    $input.removeClass('is-invalid');
                }
            });
        });
    </script>
@endsection