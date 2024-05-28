@layout('templates/master')
@section('titulo')
    Registro Estatal de Regulaciones
@endsection
@section('navbar')
    @include('templates/navbarRevisor')
@endsection
@section('menu')
    @include('templates/menuRevisor')
@endsection

@section('contenido')
    <!-- Contenido -->
    <div class="container-fluid px-4">
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="<?php echo base_url('home/home_revisor'); ?>"><i class="fas fa-home me-1"></i>Home</a>
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
                                        <i class="fas fa-edit" title="Editar usuario"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm btn-sm"
                                        data-id_usuario="<?php echo $usuario->ID_Usuario; ?>"><i class="fas fa-trash"
                                            title="Eliminar usuario"></i></button>
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
@section('js')
    <script>
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
    <script src="<?php echo base_url('assets/js/tablaIdioma.js'); ?>"></script>
@endsection
