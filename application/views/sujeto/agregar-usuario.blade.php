@include('templates/header')

<body class="sb-nav-fixed cuerpo-sujeto">
    <!-- Navbar -->
    @include('templates/navbar')
    <!-- Navbar -->

    <div id="layoutSidenav">
        <!-- Menu -->
        @include('templates/menu')
        <!-- Menu -->


        <div id="layoutSidenav_content">
            <main>
                <div class="container mt-5">
                    <div class="row justify-content-center div-formUsuario">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header header-usuario text-white">Agregar Usuario</div>
                                <div class="card-body">

                                    <!-- Formulario de agregar usuario -->
                                    <form class="row g-3 " action="<?php echo base_url('usuarios/insertar'); ?>" method="post">
                                        <div class="form-group">
                                            <label for="inputCorreo">Correo electronico<span
                                                    class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="inputCorreo"
                                                placeholder="Correo electronico" required>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="selectRoles">Roles<span class="text-danger">*</span></label>
                                                <select class="form-control" id="selectRoles" required>
                                                    <option disabled>Selecciona una opción</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputNombreUsuario">Nombre de servidor público<span
                                                class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="inputNombreUsuario"
                                                name="Nombre_servidor_publico">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputApellidoPaterno">Apellido paterno<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="inputApellidoPaterno"
                                                    name="Apellido_Paterno" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputApellidoMaterno">Apellido materno</label>
                                                <input type="text" class="form-control" id="inputApellidoMaterno"
                                                    name="Apellido_Materno">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cargoServidorPublico">Cargo del servidor público<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="cargoServidorPublico"
                                                    name="Cargo_servidor_publico" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputTituloServidor">Título del servidor<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="inputTituloServidor"
                                                    name="Titulo_servidor" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputFechaAlto">Fecha de alto en el cargo<span
                                                        class="text-danger">*</span></label>
                                                <input type="date" class="form-control" id="inputFechaAlto"
                                                    name="Fecha_Alto" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputNumClave">Número o clave del empleador<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="inputNumClave"
                                                    name="NumClave_Empleador" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputNumTel">Número de teléfono oficial<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="inputNumTel"
                                                    name="NumTel_Oficial" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputExtension">Extensión</label>
                                                <input type="number" class="form-control" id="inputExtension"
                                                    name="Extension" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputImagen">Selecciona o arrastra un archivo</label>
                                                <input type="file" class="form-control-file" id="inputImagen" accept="image/*">
                                                <div id="preview" class="mt-3"></div>
                                            </div>
                                        </div>
                                        

                                        <div class="d-flex justify-content-end mb-3">
                                            <button type="submit"
                                                class="btn btn-guardar">Guardar</button>
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
            $('#inputImagen').on('change', function(e) {
                var file = e.target.files[0];
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview').html('<img src="' + e.target.result + '" class="img-fluid">');
                    $('#preview').append(
                        '<button class="btn btn-danger btn-sm mt-2" id="btnRemoveImage">Eliminar</button>'
                        );
                }
                reader.readAsDataURL(file);
            });

            $('#preview').on('click', '#btnRemoveImage', function() {
                $('#inputImagen').val('');
                $('#preview').html('');
            });

            $('#preview').on('dragover', function(e) {
                e.preventDefault();
                $(this).addClass('dragover');
            });

            $('#preview').on('dragleave drop', function(e) {
                e.preventDefault();
                $(this).removeClass('dragover');
            });

            $('#preview').on('drop', function(e) {
                e.preventDefault();
                var file = e.originalEvent.dataTransfer.files[0];
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview').html('<img src="' + e.target.result + '" class="img-fluid">');
                    $('#preview').append(
                        '<button class="btn btn-danger btn-sm mt-2" id="btnRemoveImage">Eliminar</button>'
                        );
                }
                reader.readAsDataURL(file);
            });
        });
    </script>

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
