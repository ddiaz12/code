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
        <li class="breadcrumb-item"><a href="<?php echo base_url('home/home_admin'); ?>"><i class="fas fa-home me-1"></i>Home</a></li>
        <li class="breadcrumb-item"><a href="<?php echo base_url('auth'); ?>"><i class="fas fa-users me-1"></i>Usuarios</a></li>
        <li class="breadcrumb-item active"><i class="fas fa-user-plus me-1"></i>Agregar usuario</li>
    </ol>
    <div class="container mt-5">
        <div class="row justify-content-center div-formUsuario">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header header-usuario text-white">Agregar Usuario</div>
                    <div class="card-body">
                        <div id="infoMessage"></div>
                        <?php echo form_open('auth/create_user', ['class' => 'row g-3', 'id' => 'formUsuarios']); ?>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipoSujeto">Tipo de sujeto obligado<span class="text-danger">*</span></label>
                                <select class="form-control" id="tipoSujeto" name="tipoSujeto" required>
                                    <option disabled selected>Selecciona una opción</option>
                                    <?php foreach ($tipos as $tipo): ?>
                                    <option value="<?php echo $tipo->ID_tipoSujeto; ?>"><?php echo $tipo->tipo_sujeto; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small id="msg_tipoSujeto" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sujetos">Sujeto obligado<span class="text-danger">*</span></label>
                                <select class="form-control" id="sujetos" name="sujetos" required>
                                    <option disabled selected>Selecciona una opción</option>
                                    <?php foreach ($sujetos as $sujeto): ?>
                                    <option value="<?php echo $sujeto->ID_sujeto; ?>"><?php echo $sujeto->nombre_sujeto; ?></option>
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
                                    <?php foreach ($unidades as $unidad): ?>
                                    <option value="<?php echo $unidad->ID_unidad; ?>"><?php echo $unidad->nombre; ?></option>
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
                                <label for="last_name">Apellido paterno<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                    placeholder="Apellido" required>
                                <small id="msg_last_name" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ap2">Apellido materno<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="ap2" name="ap2"
                                    placeholder="Apellido" required>
                                <small id="msg_ap2" class="text-danger"></small>
                            </div>
                        </div>
                        <?php if ($identity_column !== 'email'): ?>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="identity"><?php echo lang('create_user_identity_label', 'identity'); ?><span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="identity" name="identity"
                                    placeholder="Identidad" required>
                                <small id="msg_identity" class="text-danger"></small>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Teléfono<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="inputNumTel" name="phone"
                                    placeholder="Teléfono" required>
                                <small id="msg_phone" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ext">Extensión</label>
                                <input type="text" class="form-control" id="ext" name="ext"
                                    placeholder="Extension" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Correo<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Correo electronico" required>
                                <small id="msg_email" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha">Fecha de alta en el cargo<span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="fecha" name="fecha"
                                    required>
                            </div>
                            <small id="msg_fecha" class="text-danger"></small>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Contraseña<span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Contraseña" required>
                                <small id="msg_password" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirm">Confirmar contraseña<span
                                        class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="password_confirm"
                                    name="password_confirm" placeholder="Confirmar contraseña" required>
                                <small id="msg_password_confirm" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="file">Archivo</label>
                                <input type="file" class="form-control" id="file" name="file">
                                <small id="msg_file" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mb-3">
                            <button type="button" class="btn btn-secondary me-2" onclick="confirmarCancelar()">Cancelar</button>
                            <button type="button" onclick="enviarFormulario();"
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url('assets/js/tel.js'); ?>"></script>
    <script>
        function enviarFormulario() {
            var sendData = $('#formUsuarios').serialize();
            $.ajax({
                url: '<?php echo base_url('auth/create_user'); ?>',
                type: 'POST',
                dataType: 'json',
                data: sendData,
                success: function(response) {
                    if (response.status == 'success') {
                        Swal.fire(
                            '¡Éxito!',
                            'El usuario ha sido agregado correctamente.',
                            'success'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = response.redirect_url;
                            }
                        });
                    } else if (response.status == 'error') {
                        if (response.errores) {
                            $.each(response.errores, function(index, value) {
                                if ($("small#msg_" + index).length) {
                                    $("small#msg_" + index).html(value);
                                }
                            });
                            Swal.fire(
                                '¡Error!',
                                'Ha ocurrido un error al agregar el usuario. Por favor, inténtalo de nuevo.',
                                'error'
                            )
                        }
                    }
                },
                error: function() {
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
    </script>
@endsection
