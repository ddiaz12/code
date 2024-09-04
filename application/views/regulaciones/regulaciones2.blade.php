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
                    <?php        if ($regulacion->Estatus == 1): ?>
                    <?php 

            $background_color = 'gray';
            // Obtener la notificación relacionada con la regulación
            $notificacion = $this->RegulacionModel->getNotificacionPorRegulacion($regulacion->ID_Regulacion);

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
                            <button class="btn btn-secondary btn-sm btn-devolver"
                                data-id="<?php            echo $regulacion->ID_Regulacion; ?>">
                                <i class="fas fa-undo" title="Devolver"></i>
                            </button>
                            <button class="btn btn-dorado btn-sm enviar-regulacion"
                                data-id="<?php            echo $regulacion->ID_Regulacion; ?>">
                                <i class="fas fa-paper-plane" title="Enviar"></i>
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
</div>
@endsection
@section('footer')
@include('templates/footer')
@endsection

@section('js')
<script src="<?php echo base_url('assets/js/tablaIdioma.js'); ?>"></script>
<script>
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

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.enviar-regulacion').forEach(function (element) {
            element.addEventListener('click', function (event) {
                event.preventDefault();
                var id = this.getAttribute('data-id');
                var url = '<?php echo base_url('RegulacionController/enviar_regulacion/'); ?>' + id;

                Swal.fire({
                    title: '¿Enviar regulación?',
                    text: "Enviar regulacion a consejeria",
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
</script>
@endsection