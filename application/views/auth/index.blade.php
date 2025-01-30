@layout('templates/master')
@section('titulo')
Registro Estatal de Regulaciones (RER) - Usuarios
@endsection
@section('navbar')
@include('templates/navbarAdmin')
@endsection
@section('menu')
@include('templates/menuAdmin')
@endsection

@section('contenido')
<!-- Contenido -->
<div class="container-fluid px-4">
    <ol class="breadcrumb mb-4 mt-5">
        <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>"><i class="fas fa-home me-1"></i>Inicio</a>
        </li>
        <li class="breadcrumb-item active"><i class="fas fa-users me-1"></i>Usuarios</li>
    </ol>
    <h1 class="mt-4 titulo-menu">Registro Estatal de Regulaciones (RER)</h1>

    <div class="d-flex justify-content-end mb-3">
        <!-- Botón para agregar grupo -->
        <!-- <a href="<?php echo base_url('auth/create_group'); ?>" class="btn btn-primary btn-agregarGrupo">
            <i class="fas fa-plus-circle me-1"></i> Crear Grupo
        </a> -->
        <!-- Botón para agregar usuario -->
        <a href="<?php echo base_url('auth/create_user'); ?>" class="btn btn-primary btn-agregarUsuario">
            <i class="fas fa-plus-circle me-1"></i> Crear Usuario
        </a>
    </div>

    <div class="card mb-4 div-datatables">
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th class="tTabla-color">Nombre completo</th>
                        <th class="tTabla-color">Sujeto Obligado</th>
                        <th class="tTabla-color">Unidad administrativa</th>
                        <th class="tTabla-color">Grupo</th>
                        <th class="tTabla-color">Estatus</th>
                        <th class="tTabla-color">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($users as $user): ?>
                        <?php if ($user->status != 2): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user->first_name . ' ' . $user->ap1 . ' ' . $user->ap2, ENT_QUOTES, 'UTF-8'); ?>
                                </td>
                                <td><?php echo htmlspecialchars($user->sujeto, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($user->unidad, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td>
                                    <?php foreach ($user->groups as $group): ?>
                                        <a href="<?php echo base_url('auth/edit_group/' . base64_encode($group->id)); ?>"
                                            class="btn btn-dorado btn-sm" title="Editar grupo">
                                            <?php echo htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8'); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </td>
                                <td>
                                    <?php if ($user->active): ?>
                                        <button class="btn btn-danger btn-sm"
                                            onclick="confirmDeactivate(<?php echo $user->id; ?>)">
                                            <i class="fas fa-times-circle" title="Desactivar usuario"></i>Desactivar
                                        </button>
                                    <?php elseif ($user->status && $user->active == 0): ?>
                                        <button class="btn btn-secondary btn-sm"
                                            onclick="confirmActivatePending('<?php echo base64_encode($user->id); ?>')">
                                            <i class="fas fa-clock" title="Usuario pendiente"></i> Pendiente
                                        </button>
                                    <?php else: ?>
                                        <button class="btn btn-success btn-sm"
                                            onclick="confirmActivate('<?php echo base64_encode($user->id); ?>')">
                                            <i class="fas fa-check-circle" title="Activar usuario"></i>Activar
                                        </button>
                                        </a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo base_url('auth/edit_user/' . base64_encode($user->id)); ?>"
                                        class="btn btn btn-dorado btn-sm">
                                        <i class="fas fa-edit" title="Editar usuario"></i>
                                    </a>
                                    <button class="btn btn btn-secondary btn-sm"
                                        onclick="confirmPending(<?php echo $user->id; ?>)" <?php if ($user->active == 1 || $user->status == 1)
                                                                                                        echo 'disabled'; ?>>
                                        <i class="fas fa-clock" title="Usuario pendiente"></i>
                                    </button>
                                    <button class="btn btn btn-danger btn-sm btn-ocultar"
                                        onclick="confirmDelete(<?php echo $user->id; ?>)">
                                        <i class="fas fa-trash-alt" title="Eliminar usuario"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Contenido -->
@endsection
@section('footer')
@include('templates/footer')
@endsection
@section('js')
<script src="<?php echo base_url('assets/js/tablaIdioma.js'); ?>"></script>
<script>
    // Script para manejar la activación del usuario
    function confirmActivate(userId) {
        Swal.fire({
            title: '¿Quieres activar el usuario?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, activar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url('auth/activate'); ?>/' + userId,
                    type: 'POST',
                    data: {
                        'confirm': 'yes'
                    },
                    success: function(response) {
                        Swal.fire(
                            'Activado',
                            'El usuario ha sido activado correctamente.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    },
                    error: function() {
                        Swal.fire(
                            'Error',
                            'No se pudo activar al usuario.',
                            'error'
                        );
                    }
                });
            }
        });
    }

    // Script para manejar la desactivación del usuario
    function confirmDeactivate(userId) {
        Swal.fire({
            title: '¿Quieres desactivar el usuario?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, desactivar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url('auth/deactivate'); ?>/' + userId,
                    type: 'POST',
                    data: {
                        'confirm': 'yes'
                    },
                    success: function(response) {
                        Swal.fire(
                            'Desactivado',
                            'El usuario ha sido desactivado correctamente.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    },
                    error: function() {
                        Swal.fire(
                            'Error',
                            'No se pudo desactivar al usuario.',
                            'error'
                        );
                    }
                });
            }
        });
    }

    function confirmPending(userId) {
        Swal.fire({
            title: '¿Quieres mandar un correo a este usuario para que complete sus datos?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, mandar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                mostrarPantallaDeCarga();
                $.ajax({
                    url: '<?php echo base_url('auth/pending_user'); ?>/' + userId,
                    type: 'POST',
                    data: {
                        'confirm': 'yes'
                    },
                    dataType: 'json',
                    success: function(result) {
                        ocultarPantallaDeCarga();
                        console.log(result);
                        if (result.status == 'success') {
                            Swal.fire(
                                'Pendiente',
                                'Usuario marcado como pendiente y correo enviado.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Error',
                                'Usuario marcado como pendiente, pero no se pudo enviar el correo.',
                                'error'
                            );
                        }
                    },
                    error: function(e) {
                        ocultarPantallaDeCarga();
                        Swal.fire(
                            'Error',
                            'No se pudo cambiar el estado del usuario.',
                            'error'
                        );
                    }
                });
            }
        });
    }

    function confirmActivatePending(userId) {
        Swal.fire({
            title: '¿Quieres activar este usuario y quitarlo de estado pendiente?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, activar',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                mostrarPantallaDeCarga();
                $.ajax({
                    url: '<?php echo base_url('auth/activate_from_pending'); ?>/' + userId,
                    type: 'POST',
                    dataType: 'json',
                    success: function(result) {
                        ocultarPantallaDeCarga();
                        if (result.status == 'success') {
                            Swal.fire(
                                'Activado',
                                'Usuario activado y correo enviado',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Error',
                                'Usuario activado, pero no se pudo enviar el correo.',
                                'error'
                            ).then(() => {
                                location.reload();
                            });
                        }
                    },
                    error: function(e) {
                        ocultarPantallaDeCarga();
                        Swal.fire(
                            'Error',
                            'No se pudo activar al usuario.',
                            'error'
                        );
                    }
                });
            }
        });
    }

    //script para eliminar usuario
    function confirmDelete(userId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Eliminar usuario.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?php echo base_url('auth/ocultar'); ?>/' + userId,
                    type: 'POST',
                    data: {
                        'confirm': 'yes'
                    },
                    success: function(response) {
                        Swal.fire(
                            'Eliminado',
                            'El usuario ha sido eliminado correctamente.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    },
                    error: function() {
                        Swal.fire(
                            'Error',
                            'No se pudo eliminar al usuario.',
                            'error'
                        );
                    }
                });
            }
        });
    }
</script>
@endsection