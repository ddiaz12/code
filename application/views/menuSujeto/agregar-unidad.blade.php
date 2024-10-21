@layout('templates/master')
@section('titulo')
Registro Estatal de Regulaciones
@endsection
@section('navbar')
@include('templates/navbarSujeto')
@endsection
@section('menu')
@include('templates/menuSujeto')
@endsection
@section('contenido')
<!-- Contenido -->
<ol class="breadcrumb mb-4 mt-5">
    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>"><i class="fas fa-home me-1"></i>Home</a>
    </li>
    <li class="breadcrumb-item"><a href="<?php echo base_url('menu/menu_unidades'); ?>"><i
                class="fas fa-building me-1"></i>Unidades
            administrativas</a></li>
    <li class="breadcrumb-item active"><i class="fa-solid fa-building-circle-check"></i>Agregar unidad
        administrativa
    </li>
</ol>
<div class="container mt-5">
    <div class="row justify-content-center div-formOficina">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header text-white">Agregar unidad
                    administrativa</div>
                <div class="card-body">

                    <!-- Formulario de Agregar unidad administrativa -->
                    <form class="row g-3" id="formUnidad">
                        <div class="form-group">
                            <label for="selectSujeto">Sujeto Obligado<span class="text-danger">*</span></label>
                            <select class="form-control" id="selectSujeto" name="sujeto" required>
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
                            <label for="inputNombre">Nombre<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputNombre" name="inputNombre"
                                placeholder="Nombre completo" required>
                            <small id="msg_inputNombre" class="text-danger"></small>
                        </div>
                        <div class="col-md-6">
                            <label for="inputSiglas">Siglas<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputSiglas" name="siglas" required>
                            <small id="msg_siglas" class="text-danger"></small>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="selectVialidad">Tipo vialidad<span class="text-danger">*</span></label>
                                <select class="form-control" id="selectVialidad" name="tipo_vialidad" required>
                                    <option disabled selected>Selecciona una opción</option>
                                    <?php foreach ($vialidades as $vialidad): ?>
                                    <option value="<?php    echo $vialidad->ID_Vialidades; ?>">
                                        <?php    echo $vialidad->Vialidad; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <small id="msg_tipo_vialidad" class="text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="inputVialidad">Nombre vialidad<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputVialidad" name="nombre_vialidad">
                            <small id="msg_nombre_vialidad" class="text-danger"></small>
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
                                <input type="number" class="form-control" id="num_exterior" name="num_exterior"
                                    required>
                                <small id="msg_num_exterior" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="selectMunicipio">Municipio</label>
                                <select class="form-control" id="selectMunicipio" name="municipio" required>
                                    <option disabled selected>Selecciona una opción</option>
                                    @foreach ($municipios as $municipio)
                                        <option value="<?php    echo $municipio->ID_Municipio; ?>">
                                            <?php    echo $municipio->Nombre_municipio; ?></option>
                                    @endforeach;
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="selectLocalidad">Nombre localidad</label>
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
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="claveLocalidad">Clave localidad</label>
                                <input type="number" class="form-control" id="claveLocalidad" name="clave_localidad"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="selectTipoAsentamiento">Tipo asentamiento</label>
                                <select class="form-control" id="selectTipoAsentamiento" name="tipo_asentamiento">
                                    <option disabled selected>Selecciona una opción</option>
                                </select>
                                <small id="msg_tipo_asentamiento" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="selectAsentamiento">Nombre asentamiento</label>
                                <select class="form-control" id="selectAsentamiento" name="nombre_asentamiento">
                                    <option disabled selected>Selecciona una opción</option>
                                    @foreach ($asentamientos as $asentamiento)
                                        <option value="{{ $asentamiento->ID_nAsentamiento }}"
                                            data-codigo-postal="{{ $asentamiento->CP }}">
                                            {{ $asentamiento->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <small id="msg_nombre_asentamiento" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputCP">C.P.<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="inputCP" name="codigo_postal"
                                    placeholder="Código postal" readonly>
                                <small id="msg_codigo_postal" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Número de teléfono oficial<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>
                            <small id="msg_phone" class="text-danger"></small>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputExtension">Extensión</label>
                                <input type="number" class="form-control" id="inputExtension" name="extension">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope fa-2x"></i></span>
                                </div>
                                <input type="email" class="form-control" placeholder="Email" name="email" required>
                            </div>
                            <small id="msg_email" class="text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="inputNotas">Notas</label>
                            <textarea class="form-control" id="inputNotas" name="notas"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="checkboxOficina"
                                    name="checkboxOficina">
                                <label class="form-check-label" for="checkboxOficina">
                                    ¿Usar unidad administrativa como oficina?
                                </label>
                            </div>
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

                            <!-- Modal para Agregar Horarios -->
                            @include('modal/unidadesHorarios')

                            <!-- Modal para Agregar Rango de Horarios -->
                            @include('modal/oficinaRangoHorarios')
                        </div>

                        <div class="alert alert-danger" role="alert" id="msg_error_horarios" style="display: none;">
                        </div>

                        <div class="d-flex justify-content-end mb-3">
                            <button type="button" class="btn btn-secondary me-2"
                                onclick="confirmarCancelar()">Cancelar</button>
                            <button type="button" onclick="enviarFormulario();"
                                class="btn btn-success btn-guardar">Guardar</button>
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
<script>
    function enviarFormulario() {
        var sendData = $('#formUnidad').serializeArray();
        //console.log(horarios);
        //console.log(sendData);
        sendData.push({
            name: 'horarios',
            value: JSON.stringify(horarios)
        });

        $.ajax({
            url: '<?php echo base_url('menu/insertar_unidad'); ?>',
            type: 'POST',
            dataType: 'json',
            data: sendData,
            success: function (response) {
                if (response.status == 'success') {
                    Swal.fire(
                        '¡Éxito!',
                        'La unidad administrativa ha sido agregada correctamente.',
                        'success'
                    ).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = response.redirect_url;
                        }
                    })
                } else if (response.status == 'error') {
                    $('#msg_error').hide();
                    // Mostrar el mensaje de error específico para los horarios
                    $('#msg_error_horarios').text(
                        'Ha ocurrido un error en los horarios de atención. Por favor, verifica los horarios e inténtalo de nuevo.'
                    );
                    $('#msg_error_horarios').show();
                    // Limpia los mensajes de error anteriores
                    $('.text-danger').empty();
                    if (response.errores) {
                        $.each(response.errores, function (index, value) {
                            if ($("small#msg_" + index).length) {
                                $("small#msg_" + index).html(value);
                            }
                        });
                        Swal.fire(
                            '¡Error!',
                            'Ha ocurrido un error al agregar la unidad administrativa. Por favor, inténtalo de nuevo.',
                            'error'
                        )
                    }
                }
            },
            error: function (response) {
                console.error('Error al procesar la solicitud.');
            }
        });
    }

    function confirmarCancelar() {
        Swal.fire({
            title: '¿Estás seguro de cancelar?',
            text: "Los cambios no se guardarán.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, cancelar',
            cancelButtonText: 'No, continuar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?php echo base_url('menu/menu_unidades'); ?>';
            }
        })
    }

    $(document).ready(function () {
        // Validación en tiempo real
        $('#formUnidad input, #formUnidad select').on('input change', function () {
            var $input = $(this);
            var $errorMsg = $("#msg_" + $input.attr('id'));
            if ($input.val() !== '') {
                $errorMsg.html('');
                $input.removeClass('is-invalid');
            }
        });
    });
</script>
<script src="<?php echo base_url('assets/js/tel.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/agregarHorario.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/agregarRangoHorarios.js'); ?>"></script>
@endsection