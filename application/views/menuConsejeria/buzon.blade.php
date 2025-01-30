@layout('templates/master')
@section('titulo')
Registro Estatal de Regulaciones
@endsection
@section('navbar')
@include('templates/navbarConsejeria')
@endsection
@section('menu')
@include('templates/menuConsejeria')
@endsection
@section('contenido')
<!-- Contenido -->
<div class="container-fluid px-4">
    <ol class="breadcrumb mb-4 mt-5">
        <li class="breadcrumb-item"><a href="<?php echo base_url("home") ?>"><i class="fas fa-home me-1"></i>Inicio</a>
        </li>
        <li class="breadcrumb-item active"><i class="fas fa-file-alt me-1"></i>Buzón</li>
    </ol>
    <!-- Botón para abrir otra vista -->
    <h1 class="mt-4 titulo-menu">Registro Estatal de Regulaciones (RER)</h1>

    <div class="card mb-4 div-datatables">
        <div class="card-body">
            <table id="datatablesSimple">
            <thead>
                    <tr>
                        <th class="tTabla-color">Titulo</th>
                        <th class="tTabla-color">Mensaje</th>
                        <th class="tTabla-color">Fecha de envio</th>
                        <th class="tTabla-color">Acciones</th>
                    </tr>
                <tbody>
                    <?php if (!empty($notificaciones)): ?>
                    <?php    foreach ($notificaciones as $notificacion): ?>
                    <tr>
                    <td
                            class="<?php        echo ($notificacion->leido == 0) ? 'notificacion-no-leida' : 'notificacion-leida'; ?>">
                            <?php        echo $notificacion->titulo; ?>
                        </td>
                        <td
                            class="<?php        echo ($notificacion->leido == 0) ? 'notificacion-no-leida' : 'notificacion-leida'; ?>">
                            <?php        echo $notificacion->mensaje; ?>
                        </td>
                        <td
                            class="<?php        echo ($notificacion->leido == 0) ? 'notificacion-no-leida' : 'notificacion-leida'; ?>">
                            <?php        echo $notificacion->fecha_envio; ?>
                        </td>
                        <td>
                            <button class="btn btn-dorado btn-sm marcar-leido"
                                data-id="<?php        echo $notificacion->id_notificacion; ?>" title="Marcar como leído">
                                <i class="fas fa-check" title="Marcar como leído"></i>
                            </button>
                            <button class="btn btn-danger btn-sm eliminar-notificacion" data-id="<?php echo $notificacion->id_notificacion; ?>" title="Eliminar notificación">
                                <i class="fas fa-trash" title="Eliminar"></i>
                            </button>
                        </td>
                    </tr>
                    <?php    endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="2">No hay notificaciones disponibles.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('footer')
@include('templates/footer')
@endsection

@section('js')
<script src="<?php echo base_url('assets/js/tablaIdioma.js'); ?>"></script>
<script>
        $(document).ready(function () {
        $('.marcar-leido').click(function () {
            var id = $(this).data('id');

            $.ajax({
                url: '<?php echo base_url('RegulacionController/marcar_leido/'); ?>' + id,
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        // Desactivar el botón para que no se pueda volver a marcar como leído
                        $('button[data-id="' + id + '"]').prop('disabled', true);
                        location.reload();
                    } else {
                        console.error('Error en la respuesta del servidor:', response);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error en la solicitud AJAX:', error);
                }
            });
        });
    });

    $(document).ready(function () {
        $('.eliminar-notificacion').click(function () {
            var id = $(this).data('id');

            Swal.fire({
                title: '¿Estás seguro?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: '¡Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?php echo base_url('RegulacionController/eliminar_notificacion/'); ?>' + id,
                        type: 'POST',
                        dataType: 'json',
                        success: function (response) {
                            if (response.success) {
                                Swal.fire(
                                    '¡Eliminado!',
                                    'La notificación ha sido eliminada correctamente.',
                                    'success'
                                ).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                });
                            } else {
                                Swal.fire(
                                    'Error',
                                    'No se pudo eliminar la notificación',
                                    'error'
                                );
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('Error en la solicitud AJAX:', error);
                        }
                    });
                }
            });
        });
    }); 
</script>
@endsection