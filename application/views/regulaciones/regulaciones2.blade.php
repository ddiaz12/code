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
                        <li class="breadcrumb-item"><a href="<?php echo base_url("home/home_sujeto") ?>"><i class="fas fa-home me-1"></i>Home</a>
                        </li>
                        <li class="breadcrumb-item active"><i class="fas fa-building me-1"></i>Oficinas</li>
                    </ol>
                    <!-- Botón para abrir otra vista -->
                    <div class="d-flex justify-content-end mb-3">
                        <a href="http://localhost/code/RegulacionController/caracteristicas_reg" class="btn btn-primary btn-agregarOficina">
                            <i class="fas fa-plus-circle me-1"></i> Agregar Regulacion
                        </a>
                    </div>
                    <h1 class="mt-4 titulo-menu">Registro Estatal de Regulaciones (RER)</h1>
                    <div class="card mb-4">
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th class="tTabla-color">Id</th>
                                        <th class="tTabla-color">Nombre</th>
                                        <th class="tTabla-color">Homoclave</th>
                                        <th class="tTabla-color">Estatus</th>
                                        <th class="tTabla-color">Vigencia</th>
                                        <th class="tTabla-color">Acciones</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($oficinas as $oficina): ?>
                                        <tr>
                                            <td>
                                                <?php echo $oficina->id_oficina ?>
                                            </td>
                                            <td>
                                                <?php echo $oficina->nombre ?>
                                            </td>
                                            <td>
                                                <?php echo $oficina->tipo ?>
                                            </td>
                                            <td>
                                                <?php echo $oficina->fecha ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm rounded-circle me-2"><i
                                                        class="fas fa-edit"></i></button>
                                                <button type="button" class="btn btn-danger btn-sm rounded-circle"
                                                    data-id_oficina="<?php echo $oficina->id_oficina ?>"><i
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