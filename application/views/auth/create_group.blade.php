@layout('templates/master')

@section('titulo')
    Registro Estatal de Regulaciones - Crear Grupo
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
        <li class="breadcrumb-item active"><i class="fas fa-user-plus me-1"></i>Crear Grupo</li>
    </ol>
    <div class="container mt-5">
        <div class="row justify-content-center div-formGrupo">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header header-usuario text-white">Crear Grupo</div>
                    <div class="card-body">
                        <div id="infoMessage"><?php echo $message;?></div>
                        <?php echo form_open("auth/create_group", ['class' => 'row g-3', 'id' => 'formGrupo']); ?>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="group_name">Nombre del grupo<span class="text-danger">*</span></label>
                                    <?php echo form_input($group_name, '', ['class' => 'form-control', 'id' => 'group_name']); ?>
                                    <small id="msg_group_name" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Descripción<span class="text-danger">*</span></label>
                                    <?php echo form_input($description, '', ['class' => 'form-control', 'id' => 'description']); ?>
                                    <small id="msg_description" class="text-danger"></small>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mb-3">
                                <a href="<?php echo base_url('auth'); ?>" class="btn btn-secondary btn-rounded me-2">Cancelar</a>
                                <button type="submit" class="btn btn-guardar btn-rounded">Crear grupo</button>
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
    <script>
        $(document).ready(function() {
            $('#formGrupo').submit(function(event) {
                event.preventDefault();

                var sendData = $(this).serialize();
                $.ajax({
                    url: '<?php echo base_url('auth/create_group'); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: sendData,
                    success: function(response) {
                        if (response.status == 'success') {
                            Swal.fire(
                                '¡Éxito!',
                                'El grupo ha sido creado correctamente.',
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
                                    'Ha ocurrido un error al crear el grupo. Por favor, inténtalo de nuevo.',
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
    </script>
@endsection
