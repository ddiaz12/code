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
        <li class="breadcrumb-item"><a href="<?php echo base_url("home") ?>"><i class="fas fa-home me-1"></i>Home</a>
        </li>
        <li class="breadcrumb-item active"><i class="fas fa-file-alt me-1"></i>Regulaciones</li>
    </ol>
    <!-- Botón para abrir otra vista -->
    <h1 class="mt-4 titulo-menu">Registro Estatal de Regulaciones (RER)</h1>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <div class="card mb-4 div-datatables">
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th class="tTabla-color">Id</th>
                        <th class="tTabla-color">Nombre</th>
                        <th class="tTabla-color">Homoclave</th>
                        <th class="tTabla-color">Estatus</th>
                        <th class="tTabla-color">Vigencia</th>
                        <th class="tTabla-color">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($regulaciones)): ?>
                    <?php    foreach ($regulaciones as $regulacion): ?>
                    <?php        if ($regulacion->Estatus == 2): ?>
                    <?php 
                    $background_color = 'gray';
            // Obtener la notificación relacionada con la regulación
            $notificacion = $this->NotificacionesModel->getNotificacionPorRegulacion($regulacion->ID_Regulacion);

            if ($notificacion) {
                // Calcular los días restantes
                $fecha_actual = new DateTime(); // Fecha actual
                $fecha_recepcion = new DateTime($notificacion->fecha_envio); // Fecha de recepción
                $dias_transcurridos = $fecha_actual->diff($fecha_recepcion)->days; // Diferencia en días
                $dias_restantes = max(0, 10 - $dias_transcurridos); // Días restantes

                // Cambiar color según los días restantes
                if ($dias_restantes > 0) {
                    $background_color = '#B69664'; // Verde si hay días restantes
                } else {
                    $background_color = '#7f2841'; // Rojo si se llega a cero
                }
            } else {
                $dias_restantes = 'N/A'; // Si no hay notificación, no se puede calcular
            }
                ?>
                    <tr>
                        <td><?php            echo $regulacion->ID_Regulacion; ?></td>
                        <td><?php            echo $regulacion->Nombre_Regulacion; ?></td>
                        <td><?php            echo $regulacion->Homoclave; ?></td>
                        <td>
                            <span class="status-circle"
                                style="background-color: <?php            echo $background_color; ?>;">
                                <?php            echo is_numeric($dias_restantes) ? $dias_restantes : $dias_restantes; ?>
                            </span>
                        </td>
                        <td><?php            echo $regulacion->Vigencia; ?></td>
                        <td>
                            <!-- Botones de acción en vertical -->
                            <button class="btn btn-gris btn-sm edit-row" title="Ver"
                                data-id="<?php            echo $regulacion->ID_Regulacion; ?>">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-secondary btn-sm btn-devolver" title="Regresar"
                                data-id="<?php            echo $regulacion->ID_Regulacion; ?>">
                                <i class="fas fa-undo" title="Devolver"></i>
                            </button>
                            <button class="btn btn-dorado btn-sm publicar-regulacion" title="Publicar"
                                data-id="<?php            echo $regulacion->ID_Regulacion; ?>">
                                <i class="fas fa-bullhorn" title="Publicar"></i>
                            </button>
                            <button class="btn btn-tinto btn-sm btn-trazabilidad" title="Trazabilidad"
                                data-id="<?php            echo $regulacion->ID_Regulacion; ?>" data-toggle="modal"
                                data-target="#trazabilidadModal">
                                <i class="fas fa-history"></i>
                            </button>
                            <button class="btn btn-tinto2 btn-sm btn-comentarios" title="Comentar"
                                data-id="<?php            echo $regulacion->ID_Regulacion; ?>">
                                <i class="fas fa-comments"></i>
                            </button>
                        </td>
                    </tr>
                    <?php        endif; ?>
                    <?php    endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="6">No hay datos disponibles</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal de trazabilidad -->
    @include('modal/trazabilidad')

    <!-- Modal de comentarios -->
    @include('modal/comentarios')
</div>

@endsection
@section('footer')
@include('templates/footer')
@endsection

@section('js')
<script src="<?php echo base_url('assets/js/tablaIdioma.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/buscarComentario.js'); ?>"></script>
<script>
    $(document).ready(function () {
        $('.publicar-regulacion').click(function () {
            var idRegulacion = $(this).data('id');

            // Mostrar cuadro de diálogo de confirmación
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Deseas publicar esta regulación?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, publicarla',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Realizar la solicitud AJAX para publicar la regulación
                    $.ajax({
                        url: '<?= base_url("RegulacionController/publicar_regulacion") ?>/' + idRegulacion,
                        type: 'POST',
                        success: function (response) {
                            if (typeof response === 'string') {
                                response = JSON.parse(response);
                            }

                            if (response.success) {
                                Swal.fire('Éxito', response.message, 'success').then(() => {
                                    location.reload(); // Recargar la página
                                });
                            } else {
                                Swal.fire('Error', response.message || 'Ocurrió un error.', 'error');
                            }
                        },
                        error: function () {
                            Swal.fire('Error', 'No se pudo publicar la regulación.', 'error');
                        }
                    });
                }
            });
        });
    });

    // Cargar la trazabilidad de una regulación
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.btn-trazabilidad').forEach(function (element) {
            element.addEventListener('click', function (event) {
                event.preventDefault();
                var id = this.getAttribute('data-id');
                var url = '<?php echo base_url('RegulacionController/obtenerTrazabilidad'); ?>';

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id=' + id
                })
                    .then(response => response.json()) // Asumimos que la respuesta será en formato JSON
                    .then(data => {
                        var timelineContent = '';

                        // Generar el HTML del timeline
                        data.forEach(function (registro, index) {
                            timelineContent += `
                        <li class="timeline-item">
                            <span class="timeline-date">${new Date(registro.fecha_movimiento).toLocaleDateString()}</span>
                            <div class="timeline-content">
                                <h5>${registro.usuario_responsable}</h5>
                                <p>Descripcion de movimiento: ${registro.descripcion_movimiento}</p>
                                <p>Fecha envio: ${new Date(registro.fecha_movimiento).toLocaleString()}</p>
                            </div>
                        </li>
                    `;
                        });

                        // Insertar el contenido en el modal
                        document.querySelector('#trazabilidadContent .timeline').innerHTML = timelineContent;

                        // Mostrar el modal
                        var trazabilidadModal = new bootstrap.Modal(document.getElementById('trazabilidadModal'));
                        trazabilidadModal.show();
                        
                        // Agregar evento de clic al botón de cierre
                        document.querySelector('#trazabilidadModal .close').addEventListener('click', function () {
                            trazabilidadModal.hide();
                        });
                    })
                    .catch(error => {
                        document.getElementById('trazabilidadContent').innerHTML = '<p>No se pudo cargar la trazabilidad.</p>';
                    });
            });
        });
    });

    $(document).ready(function () {
        // Captura el evento de clic en el botón de editar
        $('.edit-row').on('click', function () {
            // Obtiene el ID de la regulación del atributo data-id
            var idRegulacion = $(this).data('id');

            // Redirecciona a la URL de edición con el ID_Regulacion
            window.location.href = '<?= base_url("RegulacionController/edit_caract/"); ?>' + idRegulacion;
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.btn-devolver').forEach(function (element) {
            element.addEventListener('click', function (event) {
                event.preventDefault();
                var id = this.getAttribute('data-id');
                var url = '<?php echo base_url('RegulacionController/devolver_regulacion/'); ?>' + id;

                Swal.fire({
                    title: '¿Devolver regulación?',
                    text: "Devolver regulacion a sujeto obligado",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, devolver',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(url)
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        title: '¡Éxito!',
                                        text: data.message,
                                        icon: 'success',
                                        confirmButtonText: 'Aceptar'
                                    }).then(() => {
                                        location.reload(); // Recargar la página
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error',
                                        text: data.message,
                                        icon: 'error',
                                        confirmButtonText: 'Aceptar'
                                    });
                                }
                            })
                            .catch(error => {
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Hubo un problema al devolver la regulación.',
                                    icon: 'error',
                                    confirmButtonText: 'Aceptar'
                                });
                            });
                    }
                });
            });
        });
    });

    $(document).on('click', '.btn-comentarios', function () {
        var regulacionId = $(this).data('id');
        cargarComentarios(regulacionId);
        $('#guardarComentarioBtn').data('regulacionId', regulacionId); // Guardar el ID de la regulación en el botón de guardar
    });

    $('#guardarComentarioBtn').click(function () {
        var comentario = $('#comentarioNuevo').val();
        var regulacionId = $(this).data('regulacionId'); // Obtener el ID de la regulación almacenado en el botón de guardar

        $.ajax({
            url: '<?php echo base_url('Comentarios/guardarComentario'); ?>',
            type: 'POST',
            data: {
                comentario: comentario,
                idRegulacion: regulacionId
            },
            success: function (response) {
                var result = JSON.parse(response);
                if (result.status === 'success') {
                    alert(result.message);
                    $('#comentarioNuevo').val(''); // Limpiar el campo de comentario
                    // Recargar comentarios
                    location.reload();
                } else {
                    alert(result.message);
                }
            },
            error: function () {
                alert('Error al guardar el comentario.');
            }
        });
    });

    function cargarComentarios(regulacionId) {
        // Petición AJAX para obtener los comentarios
        $.ajax({
            url: '<?php echo base_url('Comentarios/obtenerComentarios'); ?>',
            type: 'POST',
            data: { id: regulacionId },
            success: function (response) {
                $('#comentariosContent').html(response);
                var comentariosModal = new bootstrap.Modal(document.getElementById('comentariosModal'));
                comentariosModal.show();
            },
            error: function () {
                $('#comentariosContent').html('<tr><td colspan="3">Error al cargar los comentarios.</td></tr>');
            }
        });
    }

    $(document).on('click', '.btn-eliminar-comentario', function () {
        var comentarioId = $(this).data('id');
        var regulacionId = $(this).data('regulacion-id');

        $.ajax({
            url: '<?php echo base_url('Comentarios/eliminarComentario'); ?>',
            type: 'POST',
            data: {
                id: comentarioId,
                idRegulacion: regulacionId
            },
            success: function (response) {
                var result = JSON.parse(response);
                if (result.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: result.message,
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: result.message,
                    });
                }
            },
        });
    });
</script>
@endsection