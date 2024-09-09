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
</script>
@endsection