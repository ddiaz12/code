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
<!-- Contenido -->
<div class="container-fluid px-4">
    <ol class="breadcrumb mb-4 mt-5">
        <li class="breadcrumb-item"><a href="<?php echo base_url("home") ?>"><i class="fas fa-home me-1"></i>Inicio</a>
        </li>
        <li class="breadcrumb-item active"><i class="fas fa-file-alt me-1"></i>Regulaciones</li>
    </ol>
    <!-- Botón para abrir otra vista -->
    <h1 class="mt-4 titulo-menu">Registro Estatal de Regulaciones (RER)</h1>
    <!-- <div class="d-flex justify-content-end mb-3">
            <a href="<?php echo base_url("RegulacionController/caracteristicas_reg") ?>"
                class="btn btn-primary btn-agregarOficina">
                <i class="fas fa-plus-circle me-1"></i> Agregar regulación
            </a>
        </div> -->
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
                        <?php foreach ($regulaciones as $regulacion): ?>
                            <?php if ($regulacion->Estatus == 1): ?>
                                <?php
                                $background_color = 'gray';
                                // Obtener la notificación relacionada con la regulación
                                $notificacion = $this->NotificacionesModel->getNotificacionPorRegulacion($regulacion->ID_Regulacion);

                                if ($notificacion) {
                                    // Calcular los días restantes
                                    $fecha_actual = new DateTime(); // Fecha actual
                                    $fecha_recepcion = new DateTime($notificacion->fecha_envio); // Fecha de recepción
                                    $dias_transcurridos = $fecha_actual->diff($fecha_recepcion)->days; // Diferencia en días
                                    $dias_restantes = max(0, 5 - $dias_transcurridos); // Días restantes

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
                                    <td><?php echo $regulacion->ID_Regulacion; ?></td>
                                    <td><?php echo $regulacion->Nombre_Regulacion; ?></td>
                                    <td><?php echo $regulacion->Homoclave; ?></td>
                                    <td>
                                        <span class="status-circle"
                                            style="background-color: <?php echo $background_color; ?>;">
                                            <?php echo is_numeric($dias_restantes) ? $dias_restantes : $dias_restantes; ?>
                                        </span>
                                    </td>
                                    <td><?php echo $regulacion->Vigencia; ?></td>
                                    <td>
                                        <!-- Botones de acción en vertical -->
                                        <button class="btn btn-gris btn-sm edit-row" title="Editar"
                                            data-id="<?php echo $regulacion->ID_Regulacion; ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm delete-row" title="Eliminar">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        <button class="btn btn-secondary btn-sm btn-devolver" title="Regresar"
                                            data-id="<?php echo $regulacion->ID_Regulacion; ?>">
                                            <i class="fas fa-undo" title="Devolver"></i>
                                        </button>
                                        <button class="btn btn-dorado btn-sm enviar-regulacion" title="Enviar"
                                            data-id="<?php echo $regulacion->ID_Regulacion; ?>">
                                            <i class="fas fa-paper-plane" title="Enviar"></i>
                                        </button>
                                        <button class="btn btn-tinto btn-sm btn-trazabilidad" title="Trazabilidad"
                                            data-id="<?php echo $regulacion->ID_Regulacion; ?>" data-toggle="modal"
                                            data-target="#trazabilidadModal">
                                            <i class="fas fa-history"></i>
                                        </button>
                                        <button class="btn btn-tinto2 btn-sm btn-comentarios" title="Comentar"
                                            data-id="<?php echo $regulacion->ID_Regulacion; ?>">
                                            <i class="fas fa-comments"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
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
    // Cargar la trazabilidad de una regulación
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-trazabilidad').forEach(function(element) {
            element.addEventListener('click', function(event) {
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
                        data.forEach(function(registro, index) {
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
                        document.querySelector('#trazabilidadModal .close').addEventListener('click', function() {
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
        // Evento para actualizar el estatus de las regulaciones
        $('tbody').on('click', '.delete-row', function () {
            // Obtener el ID de la regulación de la fila
            let regulacionId = $(this).closest('tr').find('td:first').text();

            // Confirmar la actualización
            Swal.fire({
                title: '¿Estás seguro de que deseas Eliminar esta regulación?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Hacer una solicitud AJAX para actualizar el estatus en la base de datos
                    $.ajax({
                        url: 'RegulacionController/actualizar_estatus', // Ruta en tu backend
                        type: 'POST',
                        data: {
                            id: regulacionId,
                            csrf_test_name: '<?= $this->security->get_csrf_hash(); ?>' // Token CSRF para seguridad
                        },
                        success: function (response) {
                            let res = JSON.parse(response);
                            if (res.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Éxito',
                                    text: 'Estatus actualizado exitosamente.',
                                }).then(() => {
                                    window.location.href = '<?php echo base_url("RegulacionController"); ?>';
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Hubo un error al actualizar el estatus.',
                                });
                            }
                        },
                        error: function () {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Hubo un error al actualizar el estatus.',
                            });
                        }
                    });
                }
            });
        });

        // Captura el evento de clic en el botón de editar
        $('#datatablesSimple').on('click', '.edit-row', function () {
            // Obtiene el ID de la regulación del atributo data-id
            var idRegulacion = $(this).data('id');

            // Redirecciona a la URL de edición con el ID_Regulacion
            window.location.href = '<?= base_url("RegulacionController/edit_caract/"); ?>' + idRegulacion;
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-devolver').forEach(function(element) {
            element.addEventListener('click', function(event) {
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

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.enviar-regulacion').forEach(function(element) {
            element.addEventListener('click', function(event) {
                event.preventDefault();
                var id = this.getAttribute('data-id');
                var url = '<?php echo base_url('RegulacionController/enviar_regulacion/'); ?>' + id;

                Swal.fire({
                    title: '¿Enviar regulación?',
                    text: "Enviar regulación a consejería Jurídica",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, Enviar',
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
                                    text: 'Hubo un problema al enviar la regulación.',
                                    icon: 'error',
                                    confirmButtonText: 'Aceptar'
                                });
                            });
                    }
                });
            });
        });
    });

    $(document).on('click', '.btn-comentarios', function() {
        var regulacionId = $(this).data('id');
        cargarComentarios(regulacionId);
        $('#guardarComentarioBtn').data('regulacionId', regulacionId); // Guardar el ID de la regulación en el botón de guardar
    });

    $('#guardarComentarioBtn').click(function() {
        var comentario = $('#comentarioNuevo').val();
        var regulacionId = $(this).data('regulacionId'); // Obtener el ID de la regulación almacenado en el botón de guardar

        $.ajax({
            url: '<?php echo base_url('Comentarios/guardarComentario'); ?>',
            type: 'POST',
            data: {
                comentario: comentario,
                idRegulacion: regulacionId
            },
            success: function(response) {
                var result = JSON.parse(response);
                if (result.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: result.message,
                    }).then(() => {
                        $('#comentarioNuevo').val(''); // Limpiar el campo de comentario
                        // Recargar comentarios
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
            error: function() {
                alert('Error al guardar el comentario.');
            }
        });
    });

    function cargarComentarios(regulacionId) {
        // Petición AJAX para obtener los comentarios
        $.ajax({
            url: '<?php echo base_url('Comentarios/obtenerComentarios'); ?>',
            type: 'POST',
            data: {
                id: regulacionId
            },
            success: function(response) {
                $('#comentariosContent').html(response);
                var comentariosModal = new bootstrap.Modal(document.getElementById('comentariosModal'));
                comentariosModal.show();
            },
            error: function() {
                $('#comentariosContent').html('<tr><td colspan="3">Error al cargar los comentarios.</td></tr>');
            }
        });
    }

    $(document).on('click', '.btn-eliminar-comentario', function() {
        var comentarioId = $(this).data('id');
        var regulacionId = $(this).data('regulacion-id');

        $.ajax({
            url: '<?php echo base_url('Comentarios/eliminarComentario'); ?>',
            type: 'POST',
            data: {
                id: comentarioId,
                idRegulacion: regulacionId
            },
            success: function(response) {
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