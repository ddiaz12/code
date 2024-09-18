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
            <!-- Modal de trazabilidad -->
            <div class="modal fade" id="trazabilidadModal" tabindex="-1" role="dialog"
                aria-labelledby="trazabilidadModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="trazabilidadModalLabel">Trazabilidad</h5>
                        </div>
                        <div class="modal-body">
                            <div id="trazabilidadContent">
                                <!-- Aquí se cargará la trazabilidad en formato timeline por AJAX -->
                                <ul class="timeline">
                                    <!-- Items del timeline serán agregados dinámicamente -->
                                </ul>
                            </div>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="comentariosModal" tabindex="-1" aria-labelledby="comentariosModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="comentariosModalLabel">Comentarios</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <textarea class="form-control" id="comentarioNuevo" placeholder="Comentario"></textarea>
                    <input type="text" id="buscarComentario" class="form-control my-3" placeholder="Buscar comentario">
                    <button class="btn btn-warning" id="buscarBtn">Buscar</button>

                    <!-- Aquí se mostrarán los comentarios -->
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>Comentario</th>
                                <th>Usuario</th>
                                <th>Fecha y hora de creación</th>
                            </tr>
                        </thead>
                        <tbody id="comentariosContent">
                            <!-- Aquí se insertarán los comentarios via AJAX -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary btn-agregarOficina"
                        id="guardarComentarioBtn">Guardar</button>
                </div>
            </div>
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

    $('#guardarComentarioBtn').click(function () {
        var comentario = $('#comentarioNuevo').val();
        var regulacionId = $('.btn-comentarios').data('id'); // Asume que ya tienes el ID de la regulación cargado en algún lugar

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
                    cargarComentarios(regulacionId);
                } else {
                    alert(result.message);
                }
            },
            error: function () {
                alert('Error al guardar el comentario.');
            }
        });
    });


    $(document).on('click', '.btn-comentarios', function () {
        var regulacionId = $(this).data('id');

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
    });
</script>
@endsection