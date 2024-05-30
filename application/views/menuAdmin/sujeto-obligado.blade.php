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

        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?php echo base_url('home/home_admin'); ?>"><i class="fas fa-home me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item active"><i class="fas fa-user me-1"></i>Sujeto obligado</li>
        </ol>
        <h1 class="mt-4 titulo-menu">Registro Estatal de Regulaciones (RER)</h1>
        <!-- Botón para abrir otra vista -->
        <div class="d-flex justify-content-end mb-3">
            <a href="<?php echo base_url('menu/agregar_sujeto'); ?>" class="btn btn-primary btn-agregarOficina">
                <i class="fas fa-plus-circle me-1"></i> Agregar sujeto obligado
            </a>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th class="tTabla-color">Id</th>
                            <th class="tTabla-color">Nombre sujeto obligado</th>
                            <th class="tTabla-color">Siglas</th>
                            <th class="tTabla-color">Tipo</th>
                            <th class="tTabla-color">Materia</th>
                            <th class="tTabla-color">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sujetos as $sujeto): ?>
                        <tr>
                            <td><?php echo $sujeto->ID_sujeto; ?></td>
                            <td><?php echo $sujeto->nombre_sujeto; ?></td>
                            <td><?php echo $sujeto->siglas; ?></td>
                            <td><?php echo $sujeto->tipo_sujeto; ?></td>
                            <td><?php echo $sujeto->materia; ?></td>
                            <td>
                                <a href="<?php echo base_url('menu/editar_sujeto/' . $sujeto->ID_sujeto); ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit" title="Editar sujeto"></i>
                                </a>
                                <button class="btn btn-danger btn-sm" data-id_sujeto="<?php echo $sujeto->ID_sujeto; ?>">
                                    <i class="fas fa-trash" title="Eliminar sujeto"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
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
        $(document).ready(function() {
            $('#datatablesSimple').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
                }
            });
        });

        $(document).ready(function() {
            $('.btn-danger').click(function() {
                var id = $(this).data('id_sujeto');

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#b69664',
                    cancelButtonColor: '#923244',
                    confirmButtonText: '¡Sí, eliminar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '<?php echo base_url('menu/eliminar_sujeto/'); ?>' + id,
                            type: 'POST',
                            success: function(result) {
                                Swal.fire(
                                    '¡Eliminado!',
                                    'El sujeto obligado ha sido eliminado correctamente.',
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
                                    'No se pudo eliminar al sujeto obligado',
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
