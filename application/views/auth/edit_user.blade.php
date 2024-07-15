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
    <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>"><i class="fas fa-home me-1"></i>Home</a></li>
    <li class="breadcrumb-item"><a href="<?php echo base_url('auth'); ?>"><i class="fas fa-users me-1"></i>Usuarios</a>
    </li>
    <li class="breadcrumb-item active"><i class="fas fa-user-edit me-1"></i>Editar usuario</li>
</ol>
<div class="container mt-5">

    <div class="row justify-content-center div-formUsuario">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header header-usuario text-white">Editar Usuario</div>
                <div class="card-body">
                    <?php echo form_open_multipart(uri_string(), ['class' => 'row g-3', 'id' => 'formUsuarios']); ?>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tipoSujeto">Tipo de sujeto obligado<span class="text-danger">*</span></label>
                            <select class="form-control" id="tipoSujeto" name="tipoSujeto">
                                <option disabled>Selecciona una opción</option>
                                <?php foreach ($tipos as $tipo) : ?>
                                    <option value="<?php echo $tipo->ID_tipoSujeto; ?>" <?php echo $tipo->ID_tipoSujeto == $user->id_tipoSujeto ? 'selected' : ''; ?>>
                                        <?php echo $tipo->tipo_sujeto; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <small id="msg_tipoSujeto" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sujetos">Sujeto obligado<span class="text-danger">*</span></label>
                            <select class="form-control" id="sujetos" name="sujetos">
                                <option disabled selected>Selecciona una opción</option>
                                <?php foreach ($sujetos as $sujeto) : ?>
                                    <option value="<?php echo $sujeto->ID_sujeto; ?>" <?php echo $sujeto->ID_sujeto == $user->id_sujeto ? 'selected' : ''; ?>>
                                        <?php echo $sujeto->nombre_sujeto; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <small id="msg_sujetos" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="unidades">Unidad administrativa<span class="text-danger">*</span></label>
                            <select class="form-control" id="unidades" name="unidades">
                                <option disabled selected>Selecciona una opción</option>
                                <?php foreach ($unidades as $unidad) : ?>
                                    <option value="<?php echo $unidad->ID_unidad; ?>" <?php echo $unidad->ID_unidad == $user->id_unidad ? 'selected' : ''; ?>>
                                        <?php echo $unidad->nombre; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <small id="msg_unidades" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_name">Nombre<span class="text-danger">*</span></label>
                            <?php echo form_input($first_name, '', ['class' => 'form-control', 'id' => 'first_name']); ?>
                            <small id="msg_first_name" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="last_name">Primer apellido<span class="text-danger">*</span></label>
                            <?php echo form_input($last_name, '', ['class' => 'form-control', 'id' => 'last_name']); ?>
                            <small id="msg_last_name" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ap2">Segundo apellido</label>
                            <?php echo form_input($ap2, '', ['class' => 'form-control', 'id' => 'ap2']); ?>
                            <small id="msg_ap2" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ext">Extensión</label>
                            <?php echo form_input($ext, '', ['class' => 'form-control', 'id' => 'ext']); ?>
                            <small id="msg_ext" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">Teléfono<span class="text-danger">*</span></label>
                            <?php echo form_input($phone, '', ['class' => 'form-control', 'id' => 'phone']); ?>
                            <small id="msg_phone" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fecha">Fecha de alta en el cargo<span class="text-danger">*</span></label>
                            <?php echo form_input($fecha, '', ['class' => 'form-control', 'id' => 'fecha']); ?>
                        </div>
                        <small id="msg_fecha" class="text-danger"></small>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cargo">Cargo</label>
                            <?php echo form_input($cargo, '', [
                                'class' => 'form-control', 'id' => 'cargo',
                                'placeholder' => 'Cargo del servidor público'
                            ]); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="titulo">Titulo</label>
                            <?php echo form_input($titulo, '', [
                                'class' => 'form-control', 'id' => 'titulo',
                                'placeholder' => 'Titulo'
                            ]); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="clave_empleado">Clave empleado</label>
                            <?php echo form_input($clave_empleado, '', [
                                'class' => 'form-control', 'id' => 'clave_empleado',
                                'placeholder' => 'Número o clave del empleado'
                            ]); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <?php echo form_input($password, '', [
                                'class' => 'form-control', 'id' => 'password',
                                'placeholder' => 'Contraseña'
                            ]); ?>
                            <small id="msg_password" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password_confirm">Confirmar contraseña</label>
                            <?php echo form_input($password_confirm, '', [
                                'class' => 'form-control',
                                'id' => 'password_confirm',
                                'placeholder' => 'Escribe de nuevo tu contraseña'
                            ]); ?>
                            <small id="msg_password_confirm" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="file">Archivo</label>
                            <input type="file" class="form-control" id="userfile" name="userfile">
                            <!-- Mostrar el nombre del archivo actual -->
                            <?php if (!empty($archivo)) : ?>
                                <small id="current_file" class="form-text text-muted">
                                    Archivo actual: <?php echo basename($archivo); ?>
                                </small>
                                <br>
                                <!-- Mostrar la imagen actual -->
                                <img src="<?php echo base_url('assets/ftp/' . basename($archivo)); ?>" alt="Imagen actual" class="img-fluid">
                            <?php endif; ?>
                            <br>
                            <small id="msg_file" class="text-danger"></small>
                        </div>
                    </div>
                    <?php if ($this->ion_auth->is_admin()) : ?>
                        <div class="col-md-12">
                            <h3>Asignar rol</h3>
                            <select name="groups[]" class="form-control">
                                <?php foreach ($groups as $group) : ?>
                                    <option value="<?php echo $group['id']; ?>" <?php echo in_array($group['id'], array_column($currentGroups, 'id')) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($group['name'], ENT_QUOTES, 'UTF-8'); ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    <?php endif ?>

                    <?php echo form_hidden('id', $user->id); ?>

                    <div class="d-flex justify-content-end mb-3">
                        <button type="button" class="btn btn-secondary me-2" onclick="confirmarCancelar()">Cancelar</button>
                        <button type="button" onclick="enviarFormulario();" class="btn btn-guardar btn-rounded">Guardar</button>
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
        var formData = new FormData($('#formUsuarios')[0]);
        mostrarPantallaDeCarga();
        $.ajax({
            url: '<?php echo base_url('auth/edit_user/' . base64_encode($user->id)); ?>',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                ocultarPantallaDeCarga();
                if (response.status == 'success') {
                    Swal.fire(
                        '¡Éxito!',
                        'El usuario ha sido actualizado correctamente.',
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
                        $.each(response.errores, function(index, value) {
                            if ($("small#msg_" + index).length) {
                                $("small#msg_" + index).html(value);
                            }
                        });
                    }
                    Swal.fire(
                        '¡Error!',
                        'Ha ocurrido un error al actualizar el usuario. Por favor, inténtalo de nuevo.',
                        'error'
                    )
                }
            },
            error: function() {
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

    $(document).ready(function() {
        // Validación en tiempo real
        $('#formUsuarios input, #formUsuarios select').on('input change', function() {
            var $input = $(this);
            var $errorMsg = $("#msg_" + $input.attr('id'));
            if ($input.val() !== '') {
                $errorMsg.html('');
                $input.removeClass('is-invalid');
            }
        });
    });

    // Validación en tiempo real para el campo de archivo
    $('#userfile').on('change', function() {
        $('#msg_file').text('');
        $(this).removeClass('is-invalid');
    });
</script>
@endsection