@layout('templates/masterForm')

@section('titulo')
Registro Estatal de Regulaciones
@endsection

@section('contenido')
<div class="container mt-5">
    <div class="row justify-content-center div-formUsuario">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header header-usuario text-white">Solicitud de registro</div>
                <div class="card-body">
                    <?php echo form_open_multipart(uri_string(), ['class' => 'row g-3', 'id' => 'formSolicitud']); ?>
                    <div class="form-group" style="display: none;">
                        <!-- Utiliza display: none; para esconder el campo -->
                        <label for="tipoSujeto">Tipo de sujeto obligado<span class="text-danger">*</span></label>
                        <select class="form-control" id="tipoSujeto" name="tipoSujeto" required>
                            <option disabled>Selecciona una opción</option>
                            <?php foreach ($tipos as $index => $tipo): ?>
                            <option value="<?php    echo $tipo->ID_tipoSujeto; ?>" <?php    echo isset($user) && $tipo->ID_tipoSujeto == $user->id_tipoSujeto ? 'selected' : ($index === 2 ? 'selected' : ''); ?>>
                                <?php    echo $tipo->tipo_sujeto; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                        <small id="msg_tipoSujeto" class="text-danger"></small>
                    </div>
                    <div class="col-md-6" style="display: none;"> <!-- Utiliza display: none; para esconder el campo -->
                        <div class="form-group">
                            <label for="unidades">Unidad administrativa<span class="text-danger">*</span></label>
                            <select class="form-control" id="unidades" name="unidades" required>
                                <option disabled selected>Selecciona una opción</option>
                                <?php foreach ($unidades as $index => $unidad): ?>
                                <option value="<?php    echo $unidad->ID_unidad; ?>" <?php    echo isset($user) && $unidad->ID_unidad == $user->id_unidad ? 'selected' : ($index === 0 ? 'selected' : ''); ?>>
                                    <?php    echo $unidad->nombre; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <small id="msg_unidades" class="text-danger"></small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_name">Nombre<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                placeholder="Nombre" required>
                            <small id="msg_first_name" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="last_name">Primer apellido<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                placeholder="Escribe tu primer apellido" required>
                            <small id="msg_last_name" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ap2">Segundo apellido</label>
                            <input type="text" class="form-control" id="ap2" name="ap2" placeholder="Escribe tu segundo apellido">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sujetos">Sujeto obligado<span class="text-danger">*</span></label>
                            <select class="form-control" id="sujetos" name="sujetos" required>
                                <option disabled selected>Selecciona una opción</option>
                                <?php foreach ($sujetos as $sujeto): ?>
                                <option value="<?php    echo $sujeto->ID_sujeto; ?>">
                                    <?php    echo $sujeto->nombre_sujeto; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <small id="msg_sujetos" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">Número de teléfono oficial<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                placeholder="Número de teléfono" required>
                            <small id="msg_phone" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope fa-2x"></i></span>
                            </div>
                            <input type="email" class="form-control" placeholder="Correo electrónico oficial"
                                name="email">
                        </div>
                        <small id="msg_email" class="text-danger"></small>
                    </div>

                    <div class="d-flex justify-content-end mb-3">
                        <button type="button" class="btn btn-secondary me-2"
                            onclick="confirmarCancelar()">Cancelar</button>
                        <button type="button" onclick="enviarFormulario();" class="btn btn-guardar btn-rounded">Enviar
                            solicitud</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="<?php echo base_url('assets/js/tel.js'); ?>"></script>
<script>
    function enviarFormulario() {
        var sendData = $('#formSolicitud').serializeArray();
        mostrarPantallaDeCarga();
        $.ajax({
            url: '<?php echo base_url('auth/solicitar/')?>',
            type: 'POST',
            dataType: 'json',
            data: sendData,
            success: function (response) {
                ocultarPantallaDeCarga();
                if (response.status == 'success') {
                    Swal.fire(
                        '¡Éxito!',
                        'Solicitud enviada correctamente.',
                        'success'
                    ).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = response.redirect_url;
                        }
                    });
                } else if (response.status == 'error') {
                    if (response.file_error) {
                        $('#msg_file').text(response.file_error);
                    }
                    if (response.errores) {
                        $.each(response.errores, function (index, value) {
                            if ($("small#msg_" + index).length) {
                                $("small#msg_" + index).html(value);
                            }
                        });
                    }
                    Swal.fire(
                        '¡Error!',
                        'Ha ocurrido un error al enviar la solicitud. Por favor, inténtalo mas tarde.',
                        'error'
                    )
                }
            },
            error: function () {
                ocultarPantallaDeCarga();
                console.error('Error al procesar la solicitud.');
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
                window.location.href = '<?php echo base_url('auth'); ?>';
            }
        });
    }

    $(document).ready(function () {
        // Validación en tiempo real
        $('#formSolicitud input, #formSolicitud select').on('input change', function () {
            var $input = $(this);
            var $errorMsg = $("#msg_" + $input.attr('id'));
            if ($input.val() !== '') {
                $errorMsg.html('');
                $input.removeClass('is-invalid');
            }
        });
    });

    // Validación en tiempo real para el campo de archivo
    $('#userfile').on('change', function () {
        $('#msg_file').text('');
        $(this).removeClass('is-invalid');
    });
</script>
@endsection