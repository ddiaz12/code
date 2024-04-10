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
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?php echo base_url("home/home_sujeto") ?>">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Tables</li>
                    </ol>

                    <!-- Botón para abrir otra vista -->
                    <div class="d-flex justify-content-end mb-3">
                        <a href="<?php echo base_url('oficinas/agregar_oficina'); ?>" class="btn btn-primary">
                            <i class="fas fa-eye me-1"></i> Agregar Usuario
                        </a>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre completo</th>
                                        <th>Tipo de sujeto obligado</th>
                                        <th>Sujeto obligado</th>
                                        <th>Unidad administrativa</th>
                                        <th>Estatus</th>
                                        <th>Acciones </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <!--
                                    @foreach ($usuarios as $usuario)
                                        <tr>
                                            <td>{{ $usuario->id }}</td>
                                            <td>{{ $usuario->nombre_completo }}</td>
                                            <td>{{ $usuario->tipo_sujeto_obligado }}</td>
                                            <td>{{ $usuario->sujeto_obligado }}</td>
                                            <td>{{ $usuario->unidad_administrativa }}</td>
                                            <td>{{ $usuario->estatus }}</td>
                                            <td>
                                                <a href="<?php echo base_url('usuarios/editar_usuario/' . $usuario->id); ?>"
                                                    class="btn btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="btn btn-danger" data-id_oficina="{{ $usuario->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    -->
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
        $(document).ready(function () {
            $('#datatablesSimple').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
                }
            });
        });

        $(document).ready(function () {
            $('.btn-danger').click(function () {
                var id = $(this).data('id_oficina');

                $.ajax({
                    url: '<?php echo base_url('oficinas/eliminar_oficina/') ?>' + id,
                    type: 'POST',
                    success: function (result) {
                        // Recargar la página o hacer algo con el resultado
                        location.reload();
                    }
                });
            });
        });
    </script>

</body>