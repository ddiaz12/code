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
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('home/home_sujeto'); ?>"><i class="fas fa-home me-1"></i>Home</a>
                    </li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url('menu/menu_sujeto'); ?>"><i class="fas fa-users me-1"></i>Sujeto obligado</a>
                    </li>
                    <li class="breadcrumb-item active"><i class="fas fa-user-plus me-1"></i>Agregar sujeto obligado</li>
                </ol>
                <div class="container mt-5">
                    <div class="row justify-content-center div-formUsuario">

                        <div class="col-md-9">

                            <div class="card">
                                <div class="card-header header-usuario text-white">Agregar sujeto obligado</div>
                                <div class="card-body">

                                    <!-- Formulario de agregar usuario -->
                                    <form class="row g-3 " id="formSujeto">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="TipoSujeto">Tipo de sujeto obligado<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="TipoSujeto"
                                                    name="TipoSujeto" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputEstado">Estado<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="inputEstado"
                                                    name="inputEstado" value="colima" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputSujetos">Sujeto obligado<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="inputSujetos"
                                                    name="inputSujetos" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputSiglas">Siglas<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="inputSiglas"
                                                    name="inputSiglas" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputMateria">Materia<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="inputMateria"
                                                    name="inputMateria" required>
                                            </div>
                                        </div>
                                        

                                        <div class="d-flex justify-content-end mb-3">
                                            <button type="button" onclick="enviarFormulario();"
                                                class="btn btn-guardar btn-rounded">Guardar</button>
                                            <a href="<?php echo base_url('menu/menu_sujeto'); ?>"
                                                class="btn btn-secondary btn-rounded me-2">Cancelar</a>
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
    <script src="<?php echo base_url('assets/'); ?>js/tel.js"></script>
    <script>
        $('#selectTipoSujeto').change(function() {
            var tipoSujeto = $(this).val();

            $.ajax({
                url: '<?php echo base_url('usuarios/getTipoSujetoObligado/'); ?>' + tipoSujeto,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Verifica si hay datos retornados
                    if (data) {
                        // Actualiza el valor del campo de texto con el nombre del sujeto obligado
                        $('#inputSujetos').val(data[0].nombre_sujeto);
                    } else {
                        // Si no hay datos, limpia el campo de texto
                        $('#inputSujetos').val('');
                    }
                }
            });
        });

        function enviarFormulario() {
            var sendData = $('#formUsuarios').serializeArray();
            $.ajax({
                url: '<?php echo base_url('usuarios/insertar'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {
                    'json1': sendData,
                },
                success: function(response) {
                    if (response.status == 'success') {
                        window.location.href = response.redirect_url;
                    } else {
                        console.error('Error al procesar la solicitud.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    </script>

</body>
