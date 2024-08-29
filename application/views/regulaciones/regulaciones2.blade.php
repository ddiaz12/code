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
    <div class="card mb-4 div-datatables">
        <div class="card-body">
            <div class="dataTables_length" id="datatablesSimple_length">
                <label>Mostrar
                    <select name="datatablesSimple_length" id="opSelect" aria-controls="datatablesSimple" class="">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select> registros
                </label>
            </div>
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
                    <tr>
                        <td><?php echo $regulacion['ID_Regulacion']; ?></td>
                        <td><?php echo $regulacion['Nombre_Regulacion']; ?></td>
                        <td><?php echo $regulacion['Homoclave']; ?></td>
                        <td><?php echo $regulacion['Estatus']; ?></td>
                        <td><?php echo $regulacion['Vigencia']; ?></td>
                        <td>
                            <!-- Aquí puedes agregar botones de acción como editar o eliminar -->
                        </td>
                    </tr>
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
@endsection
@section('footer')
@include('templates/footer')
@endsection

@section('js')
<script>
$(document).ready(function() {
    var table = $('#datatablesSimple').DataTable({
        "lengthMenu": [10, 25, 50, 100],
        "pageLength": 10 // Mostrar 10 registros por defecto
    });

    $('#opSelect').on('change', function() {
        var selectedValue = $(this).val();
        table.page.len(selectedValue).draw();
    });
});
</script>
@endsection