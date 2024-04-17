@include('templates/header')

<body class="sb-nav-fixed cuerpo-sujeto">
    <!-- Navbar -->
    @include('templates/navbar')
    <!-- Navbar -->

    <div id="layoutSidenav">

        <div id="layoutSidenav_content">
            <main>
                <div class="container mt-5">
                    <div class="row justify-content-center div-formUsuario">

                        <div class="col-md-9">

                            <div class="card">
                                <div class="card-header header-usuario text-white">Editar Usuario</div>
                                <div class="card-body">

                                    <!-- Formulario de actualizar usuario -->
                                    <form class="row g-3 " action="<?php echo base_url('usuarios/actualizar'); ?>" method="post">
                                        <input type="hidden" name="ID_Usuario" value="{{ $usuario->ID_Usuario }}">
                                        <div class="form-group">
                                            <label for="inputCorreo">Correo electronico<span
                                                    class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="inputCorreo"
                                                name="inputCorreo" placeholder="Correo electronico"
                                                value="{{ $usuario->Correo_Electronico }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="selectRoles">Roles<span class="text-danger">*</span></label>
                                                <select class="form-control" id="selectRoles" name="selectRoles"
                                                    required>
                                                    <option disabled>Selecciona una opción</option>
                                                    <?php foreach ($roles as $rol): ?>
                                                    <option value="<?php echo $rol->ID_rol; ?>" <?php echo $rol->ID_rol == $usuario->ID_rol ? 'selected' : ''; ?>>
                                                        <?php echo $rol->Roles; ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputNombreUsuario">Nombre<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="inputNombreUsuario"
                                                    name="inputNombreUsuario" value="{{ $usuario->Nombre }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputApellidoPaterno">Apellido paterno<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="inputApellidoPaterno"
                                                    name="inputApellidoPaterno" value="{{ $usuario->Apellido_Paterno }}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputApellidoMaterno">Apellido materno</label>
                                                <input type="text" class="form-control" id="inputApellidoMaterno"
                                                    name="inputApellidoMaterno"
                                                    value="{{ $usuario->Apellido_Materno }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputFechaAlto">Fecha de alta en el cargo<span
                                                        class="text-danger">*</span></label>
                                                <input type="date" class="form-control" id="inputFechaAlto"
                                                    name="inputFechaAlto" value="{{ $usuario->Fecha_Cargo_ROM }}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputNumTel">Número de teléfono oficial<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="inputNumTel"
                                                    name="inputNumTel" value="{{ $usuario->Num_Tel }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputExtension">Extensión</label>
                                                <input type="number" class="form-control" id="inputExtension"
                                                    name="inputExtension" value="{{ $usuario->Extension }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputCargoServidorPublico">Cargo del servidor
                                                    publico</label>
                                                <input type="text" class="form-control"
                                                    id="inputCargoServidorPublico" name="inputCargoServidorPublico">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputTitulo">Titulo</label>
                                                <input type="text" class="form-control" id="inputTitulo"
                                                    name="inputTitulo">
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
                                            <select class="form-control" id="selectEstatus" name="selectEstatus"
                                                required>
                                                <option disabled>Selecciona una opción</option>
                                                <option value="Activo" {{ $usuario->Estatus ? 'selected' : '' }}>Activo
                                                </option>
                                                <option value="Inactivo" {{ $usuario->Estatus ? '' : 'selected' }}>
                                                    Inactivo
                                                </option>
                                            </select>
                                        </div>


                                        <div class="d-flex justify-content-end mb-3">
                                            <button type="submit" class="btn btn-guardar">Actualizar</button>
                                            <a href="<?php echo base_url('usuarios/usuario'); ?>" class="btn btn-secondary me-2">Cancelar</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#inputNumTel').on('input', function() {
                let num = $(this).val().replace(/\D/g,
                    ''); // Elimina todos los caracteres que no sean dígitos
                num = num.substring(0, 10); // Limita el número a 10 dígitos

                // Formatea el número
                let formattedNum = '';
                for (let i = 0; i < num.length; i++) {
                    if (i === 0) {
                        formattedNum += '(' + num[i];
                    } else if (i === 3) {
                        formattedNum += ') ' + num[i];
                    } else if (i === 6) {
                        formattedNum += '-' + num[i];
                    } else {
                        formattedNum += num[i];
                    }
                }

                $(this).val(
                    formattedNum); // Actualiza el valor del campo de entrada con el número formateado
            });
        });
    </script>


</body>
