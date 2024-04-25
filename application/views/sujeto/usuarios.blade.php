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
        <div id="layoutSidenav_content" class="div-contenido">
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
                                        <th class="tTabla-color">Correo electronico</th>
                                        <th class="tTabla-color">Fecha</th>
                                        <th class="tTabla-color">Numero de telefono</th>
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
                                            <td>{{ $usuario->Correo_Electronico }}</td>
                                            <td>{{ $usuario->Fecha_Cargo_ROM }}</td>
                                            <td>{{ $usuario->Num_Tel }}</td>
                                            <td>{{ $usuario->Roles }}</td>
                                            <td>{{ $usuario->Estatus == 1 ? 'Activo' : 'Inactivo' }}</td>
                                            <td>
                                                <a href="<?php echo base_url('usuarios/editar/' . $usuario->ID_Usuario); ?>" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm"
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
            $('.btn-danger').click(function() {
                var id = $(this).data('id_usuario');
                $.ajax({
                    url: '<?php echo base_url('usuarios/eliminar/') ?>' + id,
                    type: 'GET',
                    success: function (result) {
                        location.reload();
                    }
                });
            });
        });
    </script>

</body>
