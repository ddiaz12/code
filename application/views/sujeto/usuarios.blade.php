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
                        <li class="breadcrumb-item active"><i class="fas fa-users me-1"></i>Usuarios</li>
                    </ol>
                    <h1 class="mt-4 titulo-menu">Registro Estatal de Regulaciones (RER)</h1>
                    <!-- Botón para abrir otra vista -->
                    <div class="d-flex justify-content-end mb-3">
                        <a href="<?php echo base_url('Usuarios/agregar_usuario'); ?>" class="btn btn-primary btn-agregarUsuario">
                            <i class="fas fa-plus-circle me-1"></i> Agregar Usuario
                        </a>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th class="tTabla-color">Id</th>
                                        <th class="tTabla-color">Nombre completo</th>
                                        <th class="tTabla-color">Tipo de sujeto obligado</th>
                                        <th class="tTabla-color">Sujeto obligado</th>
                                        <th class="tTabla-color">Unidad administrativa</th>
                                        <th class="tTabla-color">Rol</th>
                                        <th class="tTabla-color">Estatus</th>
                                        <th class="tTabla-color">Acciones </th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($usuarios as $usuario)
                                        <tr>
                                            <td>{{ $usuario->ID_Usuario }}</td>
                                            <td>{{ $usuario->Nombre }} {{ $usuario->Apellido_Paterno }}
                                                {{ $usuario->Apellido_Materno }}</td>
                                            <td>{{ $usuario->tipo_sujeto }}</td>
                                            <td>{{ $usuario->nombre_sujeto }}</td>
                                            <td>{{ $usuario->nombre }}</td>
                                            <td>{{ $usuario->Roles }}</td>
                                            <td>{{ $usuario->Estatus == 1 ? 'Activo' : 'Inactivo' }}</td>
                                            <td>
                                                <a href="<?php echo base_url('usuarios/editar/' . $usuario->ID_Usuario); ?>" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button"
                                                    class="btn btn-danger btn-sm btn-sm"
                                                    data-id_usuario="<?php echo $usuario->ID_Usuario; ?>"><i
                                                        class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach

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
            $('.btn-danger').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id_usuario');

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "No podrás revertir esta acción.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '<?php echo base_url('usuarios/eliminar/'); ?>' + id,
                            type: 'GET',
                            success: function(result) {
                                Swal.fire(
                                    '¡Eliminado!',
                                    'El usuario ha sido eliminado correctamente.',
                                    'success'
                                ).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                })
                            },
                            error: function() {
                                Swal.fire(
                                    '¡Error!',
                                    'El usuario no ha sido eliminado.',
                                    'error'
                                )
                            }
                        });
                    }
                })
            });
        });
    </script>

</body>
