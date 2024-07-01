@layout('templates/master')

@section('titulo')
    Registro Estatal de Regulaciones - Editar Grupo
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
        <li class="breadcrumb-item"><a href="<?php echo base_url('auth'); ?>"><i class="fas fa-users me-1"></i>Usuarios</a></li>
        <li class="breadcrumb-item active"><i class="fas fa-user-edit me-1"></i>Editar Grupo</li>
    </ol>
    <div class="container mt-5">
        <div class="row justify-content-center div-formGrupo">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header header-usuario text-white">Editar Grupo</div>
                    <div class="card-body">
                        <div id="infoMessage"><?php echo isset($message) ? $message : ''; ?></div>
                        <?php echo form_open(current_url(), ['class' => 'row g-3', 'id' => 'formGrupo']); ?>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="group_name">Nombre del grupo<span class="text-danger">*</span></label>
                                    <?php echo form_input($group_name, '', ['class' => 'form-control', 'id' => 'group_name']); ?>
                                    <small id="msg_group_name" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="group_description">Descripción</label>
                                    <?php echo form_input($group_description, '', ['class' => 'form-control', 'id' => 'group_description']); ?>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mb-3">
                                <button type="button" class="btn btn-secondary me-2" onclick="confirmarCancelar()">Cancelar</button>
                                <button type="submit" class="btn btn-guardar btn-rounded">Actualizar grupo</button>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#formGrupo').submit(function(event) {
                event.preventDefault();

                var sendData = $(this).serialize();
                $.ajax({
                    url: '<?php echo current_url(); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: sendData,
                    success: function(response) {
                        if (response.status == 'success') {
                            Swal.fire(
                                '¡Éxito!',
                                'El grupo ha sido actualizado correctamente.',
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
                                    'Ha ocurrido un error al actualizar el grupo. Por favor, inténtalo de nuevo.',
                                    'error'
                                )
                            }
                        }
                    },
                    error: function() {
                        console.error('Error al procesar la solicitud.');
                    }
                });
            });
        });

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
