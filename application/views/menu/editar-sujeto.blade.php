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
                    <li class="breadcrumb-item"><a href="<?php echo base_url('menu/menu_sujeto'); ?>"><i class="fas fa-users me-1"></i>Sujeto
                            obligado</a>
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
                                        <input type="hidden" name="ID_sujeto" value="{{ $sujeto->ID_sujeto }}">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="TipoSujeto">Tipo de sujeto obligado<span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control" id="TipoSujeto" name="TipoSujeto" required>
                                                    <option disabled selected>Selecciona una opción</option>
                                                    @foreach ($tipos as $tipo)
                                                        <option value="{{ $tipo->ID_tipoSujeto }}"
                                                            {{ $tipo->ID_tipoSujeto == $sujeto->ID_tipoSujeto ? 'selected' : '' }}>
                                                            {{ $tipo->tipo_sujeto }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <small id="msg_TipoSujeto" class="text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputSujetos">Sujeto obligado<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="inputSujetos"
                                                    name="inputSujetos" value="{{ $sujeto->nombre_sujeto }}" required>
                                                <small id="msg_inputSujetos" class="text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputEstado">Estado<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="inputEstado"
                                                    name="inputEstado" value="colima" readonly>
                                                <small id="msg_inputEstado" class="text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputSiglas">Siglas<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="inputSiglas"
                                                    name="inputSiglas" value="{{ $sujeto->siglas }}" required>
                                                <small id="msg_inputSiglas" class="text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputMateria">Materia<span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="inputMateria"
                                                    name="inputMateria" value="{{ $sujeto->materia }}" required>
                                                <small id="msg_inputMateria" class="text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end mb-3">
                                            <a href="<?php echo base_url('menu/menu_sujeto'); ?>"
                                                class="btn btn-secondary btn-rounded me-2">Cancelar</a>
                                            <button type="button" onclick="enviarFormulario();"
                                                class="btn btn-guardar btn-rounded">Actualizar</button>
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
        function enviarFormulario() {
            var sendData = $('#formSujeto').serializeArray();
            $.ajax({
                url: '<?php echo base_url('menu/actualizar_sujeto'); ?>',
                type: 'POST',
                dataType: 'json',
                data: sendData,
                success: function(response) {
                    if (response.status == 'success') {
                        Swal.fire(
                            '¡Éxito!',
                            'El sujeto obligado ha sido actualizado correctamente.',
                            'success'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '<?php echo base_url('menu/menu_sujeto'); ?>'
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
                                'Ha ocurrido un error al editar el sujeto obligado. Por favor, inténtalo de nuevo.',
                                'error'
                            )
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    </script>

</body>
