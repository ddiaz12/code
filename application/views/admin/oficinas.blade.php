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
        <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>"><i class="fas fa-home me-1"></i>Inicio</a>
        </li>
        <li class="breadcrumb-item active"><i class="fas fa-building me-1"></i>Oficinas</li>
    </ol>
    <h1 class="mt-4 titulo-menu">Registro Estatal de Regulaciones (RER)</h1>
    <!-- Botón para abrir otra vista -->
    <div class="d-flex justify-content-end mb-3">
        <a href="<?php echo base_url('oficinas/agregar_oficina'); ?>" class="btn btn-primary btn-agregarOficina">
            <i class="fas fa-plus-circle me-1"></i> Agregar Oficina
        </a>
    </div>
    <div class="card mb-4 div-datatables">
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th class="tTabla-color">Nombre</th>
                        <th class="tTabla-color">Tipo</th>
                        <th class="tTabla-color">Fecha de actualización</th>
                        <th class="tTabla-color">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($oficinas as $oficina): ?>
                    <tr>
                        <td>
                            <?php    echo $oficina->nombre; ?>
                        </td>
                        <td>
                            <?php    echo $oficina->tipo; ?>
                        </td>
                        <td>
                            <?php    echo $oficina->fecha_act; ?>
                        </td>
                        <td>
                            <a href="{{ base_url('oficinas/editar/' . base64_encode($oficina->ID_Oficina)) }}"
                                class="btn btn-dorado btn-sm" title="Editar oficina">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-danger btn-sm"
                                data-id_oficina="<?php    echo $oficina->ID_Oficina; ?>"><i class="fas fa-trash"
                                    title="Eliminar oficina"></i></button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
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
<script>
    $(document).ready(function () {
        $('#datatablesSimple').on('click', '.btn-danger', function () {
            var id = $(this).data('id_oficina');

            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción no se puede deshacer',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?php echo base_url('oficinas/eliminar/'); ?>' + id,
                        type: 'POST',
                        success: function (result) {
                            Swal.fire(
                                '¡Eliminado!',
                                'La oficina ha sido eliminada correctamente.',
                                'success'
                            ).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            })
                        },
                        error: function () {
                            Swal.fire(
                                'Error',
                                'No se pudo eliminar la oficina',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
</script>
<script src="<?php echo base_url('assets/js/tablaIdioma.js'); ?>"></script>
@endsection