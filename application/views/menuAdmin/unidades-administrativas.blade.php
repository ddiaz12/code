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
            <li class="breadcrumb-item active"><i class="fas fa-building me-1"></i>Unidades administrativas</li>
        </ol>
        <h1 class="mt-4 titulo-menu">Registro Estatal de Regulaciones (RER)</h1>
        <!-- Botón para abrir otra vista -->
        <div class="d-flex justify-content-end mb-3">
            <a href="<?php echo base_url('menu/agregar_unidades'); ?>" class="btn btn-primary btn-agregarOficina">
                <i class="fas fa-plus-circle me-1"></i> Agregar unidad administrativa
            </a>
        </div>
        <div class="card mb-4 div-datatables">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th class="tTabla-color">Id</th>
                            <th class="tTabla-color">Nombre de U.A</th>
                            <th class="tTabla-color">Siglas</th>
                            <th class="tTabla-color">Nombre Sujeto Obligado</th>
                            <th class="tTabla-color">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($unidades as $unidad)
                            <tr>
                                <td>{{ $unidad->ID_unidad }}</td>
                                <td>{{ $unidad->nombre }}</td>
                                <td>{{ $unidad->siglas }}</td>
                                <td>{{ $unidad->nombre_sujeto }}</td>
                                <td>
                                    <a href="{{ base_url('menu/editar_unidad/' . base64_encode($unidad->ID_unidad)) }}"
                                        class="btn btn-dorado btn-sm">
                                        <i class="fas fa-edit" title="Editar unidad"></i>
                                    </a>
                                    <button class="btn btn-danger btn-sm" data-id_unidad="<?php echo $unidad->ID_unidad; ?>">
                                        <i class="fas fa-trash" title="Eliminar unidad"></i>
                                    </button>
                                </td>
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
    <script src="<?php echo base_url('assets/js/tablaIdioma.js'); ?>"></script>
    <script>
        $(document).ready(function() {
            $('.btn-danger').click(function() {
                var id = $(this).data('id_unidad');

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '¡Sí, eliminar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '<?php echo base_url('menu/eliminar_unidad/'); ?>' + id,
                            type: 'GET',
                            success: function(result) {
                                Swal.fire(
                                    '¡Eliminado!',
                                    'La unidad administrativa ha sido eliminada correctamente.',
                                    'success'
                                ).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                })
                            },
                            error: function() {
                                Swal.fire(
                                    'Error',
                                    'No se pudo eliminar la unidad administrativa',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
