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
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>"><i class="fas fa-home me-1"></i>Home</a>
        </li>
        <li class="breadcrumb-item"><a href="<?php echo base_url('usuarios'); ?>"><i class="fas fa-users me-1"></i>Usuarios</a>
        </li>
        <li class="breadcrumb-item active"><i class="fas fa-user-plus me-1"></i>Agregar usuario</li>
    </ol>
    <div class="container mt-5">
        <div class="row justify-content-center div-formUsuario">

            <div class="col-md-9">

                <div class="card">
                    <div class="card-header header-usuario text-white">Agregar Usuario</div>
                    <div class="card-body">
                        <!-- Formulario de agregar usuario -->
                        <form class="row g-3 " id="formUsuarios">
                            <div class="form-group">
                                <label for="inputCorreo">Correo electronico<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="inputCorreo" name="inputCorreo"
                                    placeholder="Correo electronico" required>
                                <small id="msg_inputCorreo" class="text-danger"></small>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="selectRoles">Roles<span class="text-danger">*</span></label>
                                    <select class="form-control" id="selectRoles" name="selectRoles" required>
                                        <option disabled selected>Selecciona una opción</option>
                                        <?php foreach ($roles as $rol): ?>
                                        <option value="<?php echo $rol->ID_rol; ?>"><?php echo $rol->Roles; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small id="msg_selectRoles" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="selectTipoSujeto">Tipo de sujeto obligado<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" id="selectTipoSujeto" name="selectTipoSujeto" required>
                                        <option disabled selected>Selecciona una opción</option>
                                        <?php foreach ($tipos as $tipo): ?>
                                        <option value="<?php echo $tipo->ID_tipoSujeto; ?>"><?php echo $tipo->tipo_sujeto; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small id="msg_selectTipoSujeto" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="selectSujetos">Sujeto obligado<span class="text-danger">*</span></label>
                                    <select class="form-control" id="selectSujetos" name="selectSujetos" required>
                                        <option disabled selected>Selecciona una opción</option>
                                        <?php foreach ($sujetos as $sujeto): ?>
                                        <option value="<?php echo $sujeto->ID_sujeto; ?>"><?php echo $sujeto->nombre_sujeto; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small id="msg_selectSujetos" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="selectUnidades">Unidad administrativa<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control" id="selectUnidades" name="selectUnidades" required>
                                        <option disabled selected>Selecciona una opción</option>
                                        <?php foreach ($unidades as $unidad): ?>
                                        <option value="<?php echo $unidad->ID_unidad; ?>"><?php echo $unidad->nombre; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small id="msg_selectUnidades" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputNombreUsuario">Nombre<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="inputNombreUsuario"
                                        name="inputNombreUsuario">
                                    <?php echo form_error('inputNombreUsuario'); ?>
                                </div>
                                <small id="msg_inputNombreUsuario" class="text-danger"></small>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputApellidoPaterno">Apellido paterno<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="inputApellidoPaterno"
                                        name="inputApellidoPaterno" required>
                                </div>
                                <small id="msg_inputApellidoPaterno" class="text-danger"></small>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputApellidoMaterno">Apellido materno</label>
                                    <input type="text" class="form-control" id="inputApellidoMaterno"
                                        name="inputApellidoMaterno">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputFechaAlto">Fecha de alta en el cargo<span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="inputFechaAlto" name="inputFechaAlto"
                                        required>
                                </div>
                                <small id="msg_inputFechaAlto" class="text-danger"></small>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputNumTel">Número de teléfono oficial<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="inputNumTel" name="inputNumTel"
                                        required>
                                </div>
                                <small id="msg_inputNumTel" class="text-danger"></small>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputExtension">Extensión</label>
                                    <input type="number" class="form-control" id="inputExtension" name="inputExtension"
                                        maxlength="2" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputCargoServidorPublico">Cargo del servidor
                                        publico</label>
                                    <input type="text" class="form-control" id="inputCargoServidorPublico"
                                        name="inputCargoServidorPublico">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputTitulo">Titulo</label>
                                    <input type="text" class="form-control" id="inputTitulo" name="inputTitulo">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputNumeroEmpleado">Numero o clave del empleado</label>
                                    <input type="number" class="form-control" id="inputNumeroEmpleado"
                                        name="inputNumeroEmpleado">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputArchivo">Subir archivo</label>
                                    <input type="file" class="form-control" id="inputArchivo" name="inputArchivo">
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mb-3">
                                <a href="<?php echo base_url('usuarios/usuario'); ?>" class="btn btn-secondary btn-rounded me-2">Cancelar</a>
                                <button type="button" onclick="enviarFormulario();"
                                    class="btn btn-guardar btn-rounded">Guardar</button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url('assets/'); ?>js/tel.js"></script>
    <script>
        function enviarFormulario() {
            var sendData = $('#formUsuarios').serializeArray();
            $.ajax({
                url: '<?php echo base_url('usuarios/insertar'); ?>',
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
                                'Ha ocurrido un error al agregar el usuario. Por favor, inténtalo de nuevo.',
                                'error'
                            )
                        }
                    }
                },
                error: function(response) {
                    console.error('Error al procesar la solicitud.');
                }
            });
        }
    </script>
@endsection
