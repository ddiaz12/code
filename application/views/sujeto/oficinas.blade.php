@include('templates/header')

<body class="sb-nav-fixed cuerpo-sujeto">

    <!-- Navbar -->
    @include('templates/navbar')
    <!-- Navbar -->

    <div id="layoutSidenav">

        <!-- Menu -->
        @include('templates/menu')
        <!-- Menu -->

        <!-- Contenido -->
        <div id="layoutSidenav_content" class="div-img">
            <main>
                <div class="container-fluid px-4">

                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('home/home_sujeto'); ?>"><i class="fas fa-home me-1"></i>Home</a>
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
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th class="tTabla-color">Id</th>
                                        <th class="tTabla-color">Nombre</th>
                                        <th class="tTabla-color">Tipo</th>
                                        <th class="tTabla-color">Fecha de actualizacion</th>
                                        <th class="tTabla-color">Acciones</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($oficinas as $oficina): ?>
                                    <tr>
                                        <td>
                                            <?php echo $oficina->ID_Oficina; ?>
                                        </td>
                                        <td>
                                            <?php echo $oficina->nombre; ?>
                                        </td>
                                        <td>
                                            <?php echo $oficina->tipo; ?>
                                        </td>
                                        <td>
                                            <?php echo $oficina->fecha_act; ?>
                                        </td>
                                        <td>
                                            <a href="{{ base_url('oficinas/editar/' . $oficina->ID_Oficina) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm rounded-circle"
                                                data-id_oficina="<?php echo $oficina->ID_Oficina; ?>"><i
                                                    class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            @include('templates/footer')
            <!-- Footer -->
        </div>
        <!-- Contenido -->
    </div>

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
                var id = $(this).data('id_oficina');

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: 'Esta acción no se puede deshacer',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#b69664',
                    cancelButtonColor: '#923244',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '<?php echo base_url('oficinas/eliminar/'); ?>' + id,
                            type: 'POST',
                            success: function(result) {
                                Swal.fire(
                                    '¡Eliminado!',
                                    'La oficina ha sido eliminado correctamente.',
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

</body>
