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
        <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>"><i class="fas fa-home me-1"></i>Home</a>
        </li>
        <li class="breadcrumb-item active"><i class="fas fa-file me-1"></i>Regulaciones publicadas</li>
    </ol>
    <h1 class="mt-4 titulo-menu">Registro Estatal de Regulaciones (RER)</h1>
    <div class="card mb-4 div-datatables">
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th class="tTabla-color">Id</th>
                        <th class="tTabla-color">Nombre</th>
                        <th class="tTabla-color">Homoclave</th>
                        <th class="tTabla-color">Estatus</th>
                        <th class="tTabla-color">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!empty($regulaciones) && !empty($publicadas))
                        @foreach ($regulaciones as $regulacion)
                            @foreach ($publicadas as $publicada)
                                @if ($regulacion->ID_Regulacion == $publicada->ID_Regulacion)
                                    <tr>
                                        <td>{{ $publicada->ID_Regulacion }}</td>
                                        <td>{{ $publicada->Nombre_Regulacion }}</td>
                                        <td>{{ $publicada->Homoclave }}</td>
                                        <td>
                                            @if ($publicada->publicada == 1)
                                                Regulación publicada
                                            @endif
                                        </td>
                                        <td>
                                            <a href="<?php                echo base_url('ciudadania/verRegulacion/' . $publicada->ID_Regulacion); ?>"
                                                class="btn btn-danger btn-sm">
                                                <i class="fas fa-eye" title="Ver regulacion"></i>
                                            </a>
                                            <button class="btn btn-dorado btn-sm modificar-regulacion"
                                                data-id="<?php                echo $publicada->ID_Regulacion; ?>">
                                                <i class="fas fa-sync-alt" title="Modificar regulacion"></i>
                                            </button>
                                            <button class="btn btn-tinto btn-sm btn-trazabilidad" title="Trazabilidad"
                                                data-id="{{ $regulacion->ID_Regulacion }}" data-toggle="modal"
                                                data-target="#trazabilidadModal">
                                                <i class="fas fa-history"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal de trazabilidad -->
    @include('modal/trazabilidad')
</div>
<!-- Contenido -->
@endsection
@section('footer')
@include('templates/footer')
@endsection
@section('js')
<script>
    $(document).ready(function () {
        $('#datatablesSimple').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
            }
        });
    });

    $(document).ready(function () {
        $('.modificar-regulacion').on('click', function () {
            var regulacionId = $(this).data('id');

            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Quieres cambiar el estatus de esta regulación a modificada?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, cambiarlo!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?php echo base_url('menu/modificarRegulacion'); ?>',
                        type: 'POST',
                        data: {
                            id: regulacionId
                        },
                        success: function (response) {
                            var result = JSON.parse(response);
                            if (result.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Éxito',
                                    text: 'Estatus de la regulación cambio a modificada.',
                                }).then(() => {
                                    location.reload(); // Recargar la página para reflejar los cambios
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Error al cambiar el estatus de la regulación.',
                                });
                            }
                        },
                        error: function () {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Error en la solicitud AJAX.',
                            });
                        }
                    });
                }
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
                                <p>Fecha: ${new Date(registro.fecha_movimiento).toLocaleString()}</p>
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