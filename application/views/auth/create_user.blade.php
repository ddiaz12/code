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
    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>"><i class="fas fa-home me-1"></i>Inicio</a></li>
    <li class="breadcrumb-item"><a href="<?php echo base_url('auth'); ?>"><i class="fas fa-users me-1"></i>Usuarios</a>
    </li>
    <li class="breadcrumb-item active"><i class="fas fa-user-plus me-1"></i>Agregar usuario</li>
</ol>
<div class="container mt-5">
    <div class="row justify-content-center div-formUsuario">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header header-usuario text-white">Agregar Usuario</div>
                <div class="card-body">
                    <div id="infoMessage"></div>
                    <?php echo form_open_multipart('auth/create_user', ['class' => 'row g-3', 'id' => 'formUsuarios']); ?>
                    <!--<div class="col-md-6">
                        <div class="form-group">
                            <label for="tipoSujeto">Tipo de sujeto obligado<span class="text-danger">*</span></label>
                            <select class="form-control" id="tipoSujeto" name="tipoSujeto" required>
                                <option disabled selected>Selecciona una opción</option>
                                <?php foreach ($tipos as $tipo): ?>
                                <option value="<?php    echo $tipo->ID_tipoSujeto; ?>">
                                    <?php    echo $tipo->tipo_sujeto; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <small id="msg_tipoSujeto" class="text-danger"></small>
                        </div>
                    </div>-->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sujetos">Sujeto Obligado<span class="text-danger">*</span></label>
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
                            <label for="unidades">Unidad administrativa<span class="text-danger">*</span></label>
                            <select class="form-control" id="unidades" name="unidades" required>
                                <option disabled selected>Selecciona una opción</option>
                                <!-- <?php foreach ($unidades as $unidad): ?>
                                <option value="<?php    echo $unidad->ID_unidad; ?>"><?php    echo $unidad->nombre; ?>
                                </option>
                                <?php endforeach; ?> -->
                            </select>
                            <small id="msg_unidades" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_name">Nombre(s)<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                placeholder="Nombre" required>
                            <small id="msg_first_name" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="last_name">Primer apellido<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                placeholder="Apellido" required>
                            <small id="msg_last_name" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ap2">Segundo apellido</label>
                            <input type="text" class="form-control" id="ap2" name="ap2" placeholder="Apellido">
                        </div>
                    </div>
                    <?php if ($identity_column !== 'email'): ?>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="identity"><?php    echo lang('create_user_identity_label', 'identity'); ?><span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="identity" name="identity"
                                placeholder="Identidad" required>
                            <small id="msg_identity" class="text-danger"></small>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">Teléfono<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Teléfono"
                                required>
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
                    <label for="email">Correo electrónico oficial<span class="text-danger">*</span></label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope fa-2x"></i></span>
                            </div>
                            <input type="email" class="form-control" placeholder="Correo electrónico oficial" id="email" name="email">
                        </div>
                        <small id="msg_email" class="text-danger"></small>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fecha">Fecha de alta en el cargo<span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="fecha" name="fecha" required>
                        </div>
                        <small id="msg_fecha" class="text-danger"></small>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cargo">Cargo</label>
                            <input type="text" class="form-control" id="cargo" name="cargo"
                                placeholder="Cargo del servidor público">
                        </div>
                        <small id="msg_cargo" class="text-danger"></small>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título">
                        </div>
                        <small id="msg_titulo" class="text-danger"></small>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="clave_empleado">clave empleado</label>
                            <input type="text" class="form-control" id="clave_empleado" name="clave_empleado"
                                placeholder="Número o clave del empleado">
                        </div>
                        <small id="msg_clave_empleado" class="text-danger"></small>
                    </div>
                    <!-- <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Contraseña<span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Contraseña" required>
                            <small id="msg_password" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password_confirm">Confirmar contraseña<span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password_confirm" name="password_confirm"
                                placeholder="Confirmar contraseña" required>
                            <small id="msg_password_confirm" class="text-danger"></small>
                        </div>
                    </div> -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="file">Archivo</label>
                            <input type="file" class="form-control" id="userfile" name="userfile" accept="image/png, image/jpeg, application/pdf" onchange="validateFile(this)">
                            <small id="msg_file" class="text-danger"></small>
                            <button type="button" class="btn btn-secondary mt-2" onclick="document.getElementById('userfile').value = '';">Deseleccionar archivo</button>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mb-3">
                        <button type="button" class="btn btn-secondary me-2"
                            onclick="confirmarCancelar()">Cancelar</button>
                        <button type="button" onclick="enviaDatosFormulario();"
                            class="btn btn-guardar btn-rounded">Guardar</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
    $(document).ready(function(){
        $('#phone').mask('(000) 000-0000'); 
        $('#ext').mask('000000'); 
    });

     // Manejar el cambio en el campo de selección de sujetos obligados
    $('#sujetos').change(function() {
            var sujeto_id = $(this).val();
            if (sujeto_id) {
                $.ajax({
                    url: '<?php echo base_url('auth/get_unidades_by_sujeto/'); ?>' + sujeto_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#unidades').empty();
                        $('#unidades').append('<option disabled selected>Selecciona una opción</option>');
                        $.each(data, function(key, value) {
                            $('#unidades').append('<option value="' + value.ID_unidad + '">' + value.nombre + '</option>');
                        });
                    }
                });
            } else {
                $('#unidades').empty();
                $('#unidades').append('<option disabled selected>Selecciona una opción</option>');
            }
        });
    
</script>
<script>
        function validateFile(input) {
        const maxSize = 4 * 1024 * 1024; // 4 MB en bytes
        const allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];

        if (input.files.length > 0) {
            const file = input.files[0];

            // Validar tamaño del archivo
            if (file.size > maxSize) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El archivo no debe exceder los 4 MB.',
                });
                input.value = ''; // Limpiar el campo de archivo
                return; // Detener la ejecución
            }

            // Validar tipo de archivo
            if (!allowedTypes.includes(file.type)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Formato de archivo no permitido. Solo se permiten archivos JPEG, PNG y PDF.',
                });
                input.value = ''; // Limpiar el campo de archivo
                return; // Detener la ejecución
            }
        }
    }

    function enviaDatosFormulario() {
        var formData = new FormData($('#formUsuarios')[0]);
        mostrarPantallaDeCarga();
        $.ajax({
            url: '<?php echo base_url('auth/create_user'); ?>',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                ocultarPantallaDeCarga();
                if (response.status == 'success') {
                    if ($('#userfile').val() === '') {
                        Swal.fire(
                            '¡Éxito!',
                            'El usuario ha sido agregado correctamente, pero no seleccionaste un archivo. Recuerda que tienes tres días para subirlo.',
                            'warning'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = response.redirect_url;
                            }
                        });
                    } else {
                        Swal.fire(
                            '¡Éxito!',
                            'El usuario ha sido agregado correctamente.',
                            'success'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = response.redirect_url;
                            }
                        });
                    }
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
                        'Ha ocurrido un error al agregar el usuario. Por favor, inténtalo de nuevo.',
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

    // Validación en tiempo real
    $(document).ready(function () {
        $('#formUsuarios input, #formUsuarios select').on('input change', function () {
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