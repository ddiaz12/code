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
            <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>"><i class="fas fa-home me-1"></i>Home</a>
            </li>
            <li class="breadcrumb-item active"><i class="fas fa-inbox me-1"></i>Buzon</li>
        </ol>
        <h1 class="mt-4 titulo-menu">Registro Estatal de Regulaciones (RER)</h1>
        <!-- Botón para abrir otra vista -->
        <div class="d-flex justify-content-end mb-3">
            <a href="<?php echo base_url('regulaciones/caracteristicas_reg'); ?>" class="btn btn-primary btn-guardar">
                <i class="fas fa-plus-circle me-1"></i> Agregar Regulacion
            </a>
            <a href="<?php echo base_url(''); ?>" class="btn btn-primary btn-guardar">
                <i class="fas fa-download me-1"></i> Descargar excel
            </a>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th class="tTabla-color">Id</th>
                            <th class="tTabla-color">Envio</th>
                            <th class="tTabla-color">Nombre</th>
                            <th class="tTabla-color">Homoclave</th>
                            <th class="tTabla-color">Estatus</th>
                            <th class="tTabla-color">Tipo</th>
                            <th class="tTabla-color">Vigencia</th>
                            <th class="tTabla-color">Acciones</th>
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
                var id = $(this).data('id_oficina');

                $.ajax({
                    url: '<?php echo base_url('oficinas/eliminar_oficina/'); ?>' + id,
                    type: 'POST',
                    success: function(result) {
                        // Recargar la página o hacer algo con el resultado
                        location.reload();
                    }
                });
            });
        });
    </script>
@endsection