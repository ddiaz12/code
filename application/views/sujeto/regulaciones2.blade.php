@layout('templates/master')
@section('titulo')
Registro Estatal de Regulaciones
@endsection
@section('navbar')
@include('templates/navbarSujeto')
@endsection
@section('menu')
@include('templates/menuSujeto')
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
    <div class="d-flex justify-content-end mb-3">
        <a href="<?php echo base_url("RegulacionController/caracteristicas_reg") ?>"
            class="btn btn-primary btn-agregarOficina">
            <i class="fas fa-plus-circle me-1"></i> Agregar Regulacion
        </a>
    </div>
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
                    <?php        if ($regulacion->Estatus == 0): ?>
                    <tr>
                        <td><?php            echo $regulacion->ID_Regulacion; ?></td>
                        <td><?php            echo $regulacion->Nombre_Regulacion; ?></td>
                        <td><?php            echo $regulacion->Homoclave; ?></td>
                        <td><?php            echo $regulacion->Estatus; ?></td>
                        <td><?php            echo $regulacion->Vigencia; ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-row" title="Editar"
                                data-id="<?php            echo $regulacion->ID_Regulacion; ?>">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-danger btn-sm delete-row" title="Eliminar">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            <button class="btn btn-dorado btn-sm enviar-regulacion"
                                data-id="<?php            echo $regulacion->ID_Regulacion; ?>">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                            <button class="btn btn-info btn-sm btn-trazabilidad" title="Trazabilidad"
                                data-id="<?php            echo $regulacion->ID_Regulacion; ?>" data-toggle="modal"
                                data-target="#trazabilidadModal">
                                <i class="fas fa-history"></i>
                            </button>
                            <button class="btn btn-sm btn-comentarios" title="Comentarios"
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
        // Evento para actualizar el estatus de las regulaciones
        $('tbody').on('click', '.delete-row', function () {
            // Obtener el ID de la regulación de la fila
            let regulacionId = $(this).closest('tr').find('td:first').text();

            // Confirmar la actualización
            if (confirm('¿Estás seguro de que deseas actualizar el estatus de esta regulación?')) {
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
                            alert('Estatus actualizado exitosamente.');
                            window.location.href = 'http://localhost/code/RegulacionController';
                        } else {
                            alert('Hubo un error al actualizar el estatus.');
                        }
                    },
                    error: function () {
                        alert('Hubo un error al actualizar el estatus.');
                    }
                });
            }
        });
        // Captura el evento de clic en el botón de editar
        $('.edit-row').on('click', function () {
            // Obtiene el ID de la regulación del atributo data-id
            var idRegulacion = $(this).data('id');

            // Redirecciona a la URL de edición con el ID_Regulacion
            window.location.href = '<?= base_url("RegulacionController/edit_caract/"); ?>' + idRegulacion;
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.enviar-regulacion').forEach(function (element) {
            element.addEventListener('click', function (event) {
                event.preventDefault();
                var id = this.getAttribute('data-id');
                var url = '<?php echo base_url('RegulacionController/enviar_regulacion/'); ?>' + id;

                Swal.fire({
                    title: '¿Enviar regulación?',
                    text: "Enviar regulacion a sedeco",
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
                    })
                    .catch(error => {
                        document.getElementById('trazabilidadContent').innerHTML = '<p>No se pudo cargar la trazabilidad.</p>';
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
</script>
@endsection