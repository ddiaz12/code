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
        <li class="breadcrumb-item active"><i class="fas fa-user-edit me-1"></i>Editar usuario</li>
    </ol>
    <div class="container mt-5">
        <div class="row justify-content-center div-formUsuario">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header header-usuario text-white">Editar Usuario</div>
                    <div class="card-body">
                        <div id="infoMessage"><?php echo $message;?></div>
                        <?php echo form_open(uri_string(), ['class' => 'row g-3', 'id' => 'formUsuarios']); ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name">Nombre<span class="text-danger">*</span></label>
                                    <?php echo form_input($first_name, '', ['class' => 'form-control', 'id' => 'first_name']); ?>
                                    <small id="msg_first_name" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name">Apellidos<span class="text-danger">*</span></label>
                                    <?php echo form_input($last_name, '', ['class' => 'form-control', 'id' => 'last_name']); ?>
                                    <small id="msg_last_name" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company">Empresa</label>
                                    <?php echo form_input($company, '', ['class' => 'form-control', 'id' => 'company']); ?>
                                    <small id="msg_company" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Teléfono</label>
                                    <?php echo form_input($phone, '', ['class' => 'form-control', 'id' => 'phone']); ?>
                                    <small id="msg_phone" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <?php echo form_input($password, '', ['class' => 'form-control', 'id' => 'password']); ?>
                                    <small id="msg_password" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirm">Confirmar Contraseña</label>
                                    <?php echo form_input($password_confirm, '', ['class' => 'form-control', 'id' => 'password_confirm']); ?>
                                    <small id="msg_password_confirm" class="text-danger"></small>
                                </div>
                            </div>
                            <?php if ($this->ion_auth->is_admin()): ?>
                                <div class="col-md-12">
                                    <h3>Miembros de grupos</h3>
                                    <?php foreach ($groups as $group): ?>
                                        <label class="checkbox">
                                            <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>" <?php echo in_array($group['id'], array_column($currentGroups, 'id')) ? 'checked="checked"' : null; ?>>
                                            <?php echo htmlspecialchars($group['name'], ENT_QUOTES, 'UTF-8');?>
                                        </label>
                                    <?php endforeach ?>
                                </div>
                            <?php endif ?>

                            <?php echo form_hidden('id', $user->id); ?>
                            

                            <div class="d-flex justify-content-end mb-3">
                                <a href="<?php echo base_url('auth'); ?>" class="btn btn-secondary btn-rounded me-2">Cancelar</a>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url('assets/js/tel.js'); ?>"></script>
    <script>
        function enviarFormulario() {
            var sendData = $('#formUsuarios').serialize();
            $.ajax({
                url: '<?php echo base_url('auth/edit_user/' . $user->id); ?>',
                type: 'POST',
                dataType: 'json',
                data: sendData,
                success: function(response) {
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
                        if (response.errores) {
                            $.each(response.errores, function(index, value) {
                                if ($("small#msg_" + index).length) {
                                    $("small#msg_" + index).html(value);
                                }
                            });
                            Swal.fire(
                                '¡Error!',
                                'Ha ocurrido un error al actualizar el usuario. Por favor, inténtalo de nuevo.',
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
    </script>
@endsection
