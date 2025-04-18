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
        <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>"><i class="fas fa-home me-1"></i>Inicio</a>
        </li>
        <li class="breadcrumb-item active"><i class="fas fa-file me-1"></i>Regulaciones Abrogadas</li>
    </ol>
    <h1 class="mt-4 titulo-menu">Registro Estatal de Regulaciones (RER)</h1>
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
                    @foreach ($abrogadas as $abrogada)
                        <tr>
                            <td>{{ $abrogada->Nombre_Regulacion }}</td>
                            <td>{{ $abrogada->Homoclave }}</td>
                            <td>
                                <span class="badge bg-warning text-dark">Abrogada</span>
                            </td>
                            <td>
                                <a href="<?php    echo base_url('ciudadania/verRegulacion/' . $abrogada->ID_Regulacion); ?>"
                                    class="btn btn-danger btn-sm">
                                    <i class="fas fa-eye" title="Ver regulacion"></i>
                                </a>
                                <button class="btn btn-dorado btn-sm modificar-regulacion"
                                    data-id="<?php    echo $abrogada->ID_Regulacion; ?>">
                                    <i class="fas fa-sync-alt" title="Modificar regulacion"></i>
                                </button>
                        </tr>
                        </tr>
                    @endforeach
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
                text: "¿Quieres quitarle el estatus de abrogada a esta regulacion?",
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
                                    text: 'Estatus de la regulación cambio.',
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

</script>

@endsection