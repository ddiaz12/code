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
        <li class="breadcrumb-item"><a href="<?php echo base_url("home") ?>"><i class="fas fa-home me-1"></i>Home</a>
        </li>
        <li class="breadcrumb-item active"><i class="fas fa-file-alt me-1"></i>Regulaciones</li>
    </ol>
    <!-- Botón para abrir otra vista -->
    <h1 class="mt-4 titulo-menu">Registro Estatal de Regulaciones (RER)</h1>
    <div class="d-flex justify-content-end mb-3">
        <a href="<?php echo base_url("RegulacionController/caracteristicas_reg") ?>"
            class="btn btn-primary btn-agregarOficina">
            <i class="fas fa-plus-circle me-1"></i> Agregar Regulacion
        </a>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <div class="card mb-4 div-datatables">
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
                    <?php if (!empty($regulaciones)): ?>
                    <?php foreach ($regulaciones as $regulacion): ?>
                    <?php if ($regulacion['Estatus'] == 1): // Mostrar solo si Estatus es igual a 1 ?>
                    <tr>
                        <td><?php echo $regulacion['ID_Regulacion']; ?></td>
                        <td><?php echo $regulacion['Nombre_Regulacion']; ?></td>
                        <td><?php echo $regulacion['Homoclave']; ?></td>
                        <td><?php echo $regulacion['Estatus']; ?></td>
                        <td><?php echo $regulacion['Vigencia']; ?></td>
                        <td>
                            <!-- Botones de acción en vertical -->
                            <div class="btn-group-vertical">
                                <button class="btn btn-warning btn-sm edit-row">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-danger btn-sm delete-row">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="6">No hay datos disponibles</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    // Evento para actualizar el estatus de las regulaciones
    $('tbody').on('click', '.delete-row', function() {
        // Obtener el ID de la regulación de la fila
        let regulacionId = $(this).closest('tr').find('td:first').text();

        // Confirmar la actualización
        if (confirm('¿Estás seguro de que deseas actualizar el estatus de esta regulación?')) {
            // Hacer una solicitud AJAX para actualizar el estatus en la base de datos
            $.ajax({
                url: 'RegulacionController/actualizar_estatus', // Ruta en tu backend
                type: 'POST',
                data: {
                    id: regulacionId,
                    csrf_test_name: '<?= $this->security->get_csrf_hash(); ?>' // Token CSRF para seguridad
                },
                success: function(response) {
                    let res = JSON.parse(response);
                    if (res.status === 'success') {
                        alert('Estatus actualizado exitosamente.');
                        window.location.href ='http://localhost/code/RegulacionController';
                    } else {
                        alert('Hubo un error al actualizar el estatus.');
                    }
                },
                error: function() {
                    alert('Hubo un error al actualizar el estatus.');
                }
            });
        }
    });
});
</script>

@endsection
@section('footer')
@include('templates/footer')
@endsection

@section('js')
<script src="<?php echo base_url('assets/js/tablaIdioma.js'); ?>"></script>
@endsection