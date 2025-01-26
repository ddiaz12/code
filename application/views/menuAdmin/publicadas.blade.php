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
        <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>"><i class="fas fa-home me-1"></i>Home</a>
        </li>
        <li class="breadcrumb-item active"><i class="fas fa-file me-1"></i>Regulaciones publicadas</li>
    </ol>
    <h1 class="mt-4 titulo-menu">Registro Estatal de Regulaciones (RER)</h1>
    <div class="d-flex justify-content-end mb-3">
        <a href="<?php echo base_url('PhpSpreadsheet/descargarRegulaciones'); ?>" class="btn btn-primary btn-agregar">
            <i class="fas fa-download me-1"></i> Descargar fichas 
        </a>
        <a href="<?php echo base_url('PhpSpreadsheet/descargarRegulacionesOrdenamiento'); ?>" class="btn btn-primary btn-agregarOficina">
            <i class="fas fa-download me-1"></i> Descargar excel por ordenamiento
        </a>
    </div>
    <div class="card mb-4 div-datatables">
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
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
                                            <button class="btn btn-gris btn-sm edit-row" title="Editar"
                                                data-id="<?php            echo $regulacion->ID_Regulacion; ?>">
                                                <i class="fas fa-edit"></i>
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
</script>
<script>
    $(document).ready(function () {
        // Captura el evento de clic en el botón de editar
        $('.edit-row').on('click', function () {
            // Obtiene el ID de la regulación del atributo data-id
            var idRegulacion = $(this).data('id');

            // Redirecciona a la URL de edición con el ID_Regulacion
            window.location.href = '<?= base_url("PublicadasController/edit_public_caract/"); ?>' + idRegulacion;
        });
    });
</script>

@endsection