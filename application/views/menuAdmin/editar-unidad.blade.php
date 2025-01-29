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
<!-- Contenido -->
<ol class="breadcrumb mb-4 mt-5">
    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>"><i class="fas fa-home me-1"></i>Home</a>
    </li>
    <li class="breadcrumb-item"><a href="<?php echo base_url('menu/menu_unidades'); ?>"><i
                class="fas fa-cogs me-1"></i>Unidades
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
                        <input type="hidden" name="id_unidad" value="{{ $unidades->ID_unidad }}">
                        <div class="form-group">
                            <label for="selectSujeto">Sujeto Obligado<span class="text-danger">*</span></label>
                            <select class="form-control" id="selectSujeto" name="sujeto" required>
                                <option disabled selected>Selecciona una opción</option>
                                @foreach ($sujetos as $sujeto)
                                    <option value="{{ $sujeto->ID_sujeto }}" {{ $sujeto->ID_sujeto == $unidades->ID_sujeto ? 'selected' : '' }}>
                                        {{ $sujeto->nombre_sujeto }}
                                    </option>
                                @endforeach
                            </select>
                            <small id="msg_selectSujeto" class="text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="inputNombre">Nombre<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputNombre" name="inputNombre"
                                placeholder="Nombre completo" value="{{ $unidades->nombre }}" required>
                            <small id="msg_inputNombre" class="text-danger"></small>
                        </div>
                        <div class="col-md-6">
                            <label for="inputSiglas">Siglas<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputSiglas" name="siglas"
                                value="{{ $unidades->siglas }}" required>
                            <small id="msg_siglas" class="text-danger"></small>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="selectVialidad">Tipo vialidad<span class="text-danger">*</span></label>
                                <select class="form-control" id="selectVialidad" name="tipo_vialidad" required>
                                    <option disabled selected>Selecciona una opción</option>
                                    @foreach ($vialidades as $vialidad)
                                        <option value="{{ $vialidad->ID_Vialidades }}" {{ $vialidad->ID_Vialidades == $unidades->ID_vialidad ? 'selected' : '' }}>
                                            {{ $vialidad->Vialidad }}
                                        </option>
                                    @endforeach
                                </select>
                                <small id="msg_tipo_vialidad" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputVialidad">Nombre vialidad<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="inputVialidad" name="nombre_vialidad"
                                value="{{ $unidades->nombre_vialidad }}">
                            <small id="msg_nombre_vialidad" class="text-danger"></small>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputNumInterior">Número interior</label>
                                <input type="number" class="form-control" id="inputNumInterior" name="num_interior"
                                    value="{{ $unidades->Num_interior }}">
                                <small id="msg_num_interior" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputNumExterior">Número exterior<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="inputNumExterior" name="num_exterior"
                                    value="{{ $unidades->Num_Exterior }}" required>
                                <small id="msg_num_exterior" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="selectMunicipio">Municipio</label>
                                <select class="form-control" id="selectMunicipio" name="municipio" required>
                                    <option disabled selected>Selecciona una opción</option>
                                    @foreach ($municipios as $municipio)
                                        <option value="{{ $municipio->ID_Municipio }}" {{ $municipio->ID_Municipio == $unidades->ID_municipio ? 'selected' : '' }}>
                                            {{ $municipio->Nombre_municipio }}
                                        </option>
                                    @endforeach
                                </select>
                                <small id="msg_municipio" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="selectLocalidad">Nombre localidad<span class="text-danger">*</span></label>
                                <select class="form-control" id="selectLocalidad" name="localidad" required>
                                    <option disabled selected>Selecciona una opción</option>
                                    @foreach ($localidades as $localidad)
                                        <option value="{{ $localidad->ID_localidad }}" {{ $localidad->ID_localidad == $unidades->ID_localidad ? 'selected' : '' }}
                                            data-clave="{{ $localidad->clave }}">
                                            {{ $localidad->Localidades }}
                                        </option>
                                    @endforeach;
                                </select>
                                <small id="msg_localidad" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="claveLocalidad">Clave localidad<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="claveLocalidad" name="clave_localidad"
                                    value="{{ $unidades->clave }}" readonly>
                                    <small id="msg_clave_localidad" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="selectTipoAsentamiento">Tipo asentamiento<span class="text-danger">*</span></label>
                                <select class="form-control" id="selectTipoAsentamiento" name="tipo_asentamiento">
                                    <option value="{{ $unidades->tipo_asentamiento }}" selected>
                                        {{ $unidades->tipo_asentamiento }}
                                    </option>
                                </select>
                                <small id="msg_tipo_asentamiento" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="selectAsentamiento">Nombre asentamiento<span class="text-danger">*</span></label>
                                <select class="form-control" id="selectAsentamiento" name="nombre_asentamiento">
                                    <option disabled>Selecciona una opción</option>
                                    @foreach ($asentamientos as $asentamiento)
                                        <option value="{{ $asentamiento->ID_nAsentamiento }}" 
                                        {{ $asentamiento->ID_nAsentamiento == $unidades->ID_nAsentamiento ? 'selected' : '' }} 
                                        data-codigo-postal="{{ $asentamiento->CP }}">
                                            {{ $asentamiento->nombre }}
                                        </option>
                                    @endforeach;
                                </select>
                                <small id="msg_nombre_asentamiento" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputCP">C.P.<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="inputCP" name="codigo_postal"
                                    value="{{ $unidades->CP }}" required readonly>
                                <small id="msg_codigo_postal" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Número de teléfono oficial<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="{{ $unidades->NumTel_Oficial }}" required>
                            </div>
                            <small id="msg_phone" class="text-danger"></small>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ext">Extensión</label>
                                <input type="text" class="form-control" id="ext" name="ext" maxlength="4"
                                    value="{{ $unidades->extension }}">
                                    <small id="msg_ext" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="form-group">
                        <label for="email">Correo electrónico<span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope fa-2x"></i></span>
                                </div>
                                <input type="email" class="form-control" placeholder="Email" name="email"
                                    value="{{ $unidades->Correo_Elec }}" required>
                            </div>
                            <small id="msg_email" class="text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="inputNotas">Notas</label>
                            <textarea class="form-control" id="inputNotas"
                                name="notas">{{ $unidades->Notas }}</textarea>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="checkboxOficina"
                                    name="checkboxOficina" {{ $unidades->checkOficina ? 'checked' : '' }}>
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
                                    @foreach ($horarios as $horario)
                                        <tr>
                                            <td>{{ $horario->Dia }}</td>
                                            <td>{{ $horario->Apertura }}</td>
                                            <td>{{ $horario->Cierre }}</td>
                                            <td>
                                                <!-- Botón para eliminar la fila -->
                                                <button type="button" class="btn btn-danger eliminar"
                                                    data-id="{{ $horario->ID_Horario }}">Eliminar</button>
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
                                Agregar horario
                            </button>
                            <button type="button" class="btn btn-guardar" data-bs-toggle="modal"
                                    data-bs-target="#modalAgregarRangoHorario">
                                    Agregar rango de horarios
                            </button>

                            <!-- Modal para Agregar Horarios -->
                            @include('modal/unidadesHorarios')

                            <!-- Modal para Agregar Rango de Horarios -->
                            @include('modal/oficinaRangoHorarios')
                        </div>

                        <!-- Mensaje de error -->
                        <div class="alert alert-danger" role="alert" id="msg_error_horarios" style="display: none;">
                        </div>

                        <div class="d-flex justify-content-end mb-3">
                            <button type="button" class="btn btn-secondary me-2"
                                onclick="confirmarCancelar()">Cancelar</button>
                            <button type="button" onclick="enviarFormulario();"
                                class="btn btn-success btn-guardar">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contenido -->
@endsection
@section('js')
<script src="<?php echo base_url('assets/js/apiAsentamientosEditar.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/getElementChange.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/agregarRangoHorarios.js'); ?>"></script>
<script>
    function enviarFormulario() {
        var sendData = $('#formUnidad').serializeArray();
        mostrarPantallaDeCarga();
        sendData.push({
            name: 'horarios',
            value: JSON.stringify(horarios)
        });
        sendData.push({
            name: 'horariosEliminados',
            value: JSON.stringify(horariosEliminados)
        });

        $.ajax({
            url: '<?php echo base_url('menu/actualizar_unidad'); ?>',
            type: 'POST',
            dataType: 'json',
            data: sendData,
            success: function (response) {
                ocultarPantallaDeCarga();
                if (response.status == 'success') {
                    Swal.fire(
                        '¡Éxito!',
                        'La unidad administrativa ha sido actualizada correctamente.',
                        'success'
                    ).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '<?php echo base_url('menu/menu_unidades'); ?>';
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
                            'Ha ocurrido un error al editar la unidad administrativa. Por favor, inténtalo de nuevo.',
                            'error'
                        )
                    }
                }
            },
            error: function (xhr, status, error) {
                ocultarPantallaDeCarga();
                console.error(xhr.responseText);
            }
        });
    }

    function confirmarCancelar() {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Los cambios no se guardarán.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, cancelar',
            cancelButtonText: 'No, continuar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?php echo base_url('menu/menu_unidades'); ?>';
            }
        });
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
<script src="<?php echo base_url('assets/js/eliminarHorario.js'); ?>"></script>
@endsection