
@layout('templates/master')
@section('titulo')
Registro Estatal de Regulaciones y Visitas Domiciliarias
@endsection
@section('navbar')
@include('templates/navbarAdmin')
@endsection
@section('menu')
@include('templates/menuAdmin')
@endsection

@section('contenido')
<div class="container-fluid px-4">
<ol class="breadcrumb mb-4 mt-5" style="margin-left: 69px;">
    <li class="breadcrumb-item">
        <a href="<?php echo base_url('home'); ?>" class="text-decoration-none">
            <i class="fas fa-home me-1"></i>Home
        </a>
    </li>
    <li class="breadcrumb-item"><i class="fas fa-file-alt me-1"></i>Inspecciones</li>
</ol>


    <h2 class="mt-4 text-center "><b>Registro Estatal de Visitas Domiciliarias (REVID)</b></h2>
    <h5 class="text-center mb-4">Inspecciones, Verificaciones y Visitas Domiciliarias</h5>
    
    <div style="height: 1.5cm;"></div>

    <div class="container-fluid px-4" style="max-width: calc(100% - 3cm); margin: 0 auto;">
    <div class="row align-items-center mb-3">
        <div class="col-12 col-md-8">
            <p class="text-muted mb-0">
                En este apartado encontrarás las Inspecciones, Verificaciones y Visitas Domiciliarias que se encuentran en edición y/o revisión
            </p>
        </div>
        <div class="col-12 col-md-4 text-md-end mt-3 mt-md-0">
    <a href="<?= base_url('Agregarinspeccion/agregarinspeccion'); ?>" class="btn btn-warning">
        <i class="fas fa-plus-circle me-1"></i> Agregar Inspección
    </a>
</div>

    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr style="background-color: #8E354A; color: white;">
                    <th class="text-nowrap">ID</th>
                    <th class="text-nowrap">Homoclave</th>
                    <th class="text-nowrap">Nombre</th>
                    <th class="text-nowrap">Modalidad</th>
                    <th class="text-nowrap">Sujeto Obligado</th>
                    <th class="text-nowrap">Unidad Administrativa</th>
                    <th class="text-nowrap">Estatus</th>
                    <th class="text-nowrap">Tipo</th>
                    <th class="text-nowrap">Vigencia</th>
                    <th class="text-nowrap">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="10" class="text-center py-3">No hay información disponible</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<style>
    @media (max-width: 767px) {
        .col-12.col-md-4.text-md-end {
            text-align: left !important;
        }
    }
</style>

<style>
.btn-warning {
    background-color: #8E354A;
    border-color: #8E354A;
    color: #fff;
}
.breadcrumb-item a {
    color: #0d6efd;
}
.table th {
    font-weight: normal;
}
.table-responsive {
    overflow-x: auto;
}
.table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 1rem;
    table-layout: auto;
}
.table th,
.table td {
    padding: 0.75rem;
    vertical-align: top;
    border-top: 1px solid #dee2e6;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
@media screen and (max-width: 767px) {
    .table th,
    .table td {
        white-space: normal;
        word-wrap: break-word;
    }
}
</style>

<script>
$(document).ready(function() {
    // Inicializar DataTables con configuración en español
    $('.table').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
        },
        "paging": false,
        "searching": false,
        "info": false
    });
});
</script>

@endsection
@section('footer')
@include('templates/footer')
@endsection