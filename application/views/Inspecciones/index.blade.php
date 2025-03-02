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
        <ol class="breadcrumb mb-4 mt-5">
            <li class="breadcrumb-item">
                <a href="<?php echo base_url('home'); ?>" class="text-decoration-none">
                    <i class="fas fa-home me-1"></i>Home
                </a>
            </li>
            <li class="breadcrumb-item">Inspecciones</li>
        </ol>

        <h2 class="mt-4 text-center"><b>Registro Estatal de Visitas Domiciliarias (REVID)</b></h2>
        <h5 class="text-center fs-5 fst-italic mb-4">Inspecciones, Verificaciones y Visitas Domiciliarias</h5>
        
        <div class="container-fluid px-4" style="max-width: calc(100% - 3cm); margin: 0 auto;">
            <div class="row align-items-center mb-3">
                <div class="col-12 col-md-8">
                    <p class="text-muted mb-0">
                        En este apartado encontrarás las Inspecciones, Verificaciones y Visitas Domiciliarias en edición y/o revisión.
                    </p>
                </div>
                <div class="col-12 col-md-4 text-md-end mt-3 mt-md-0">
                    <div class="btn-group">
                        <button type="button" class="btn btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-download me-1"></i> Descargar
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="<?= base_url('visitas/descargar/pdf'); ?>?ids=<?= implode(',', array_column($inspecciones, 'ID')); ?>">
                                    <i class="fas fa-file-pdf"></i> PDF
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?= base_url('visitas/descargar/excel'); ?>?ids=<?= implode(',', array_column($inspecciones, 'ID')); ?>">
                                    <i class="fas fa-file-excel"></i> Excel
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Tabla -->
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr style="background-color: #8E354A; color: white;">
                                <th>ID</th>
                                <th>Homoclave</th>
                                <th>Nombre</th>
                                <th>Modalidad</th>
                                <th>Sujeto Obligado</th>
                                <th>Unidad Administrativa</th>
                                <th>Estatus</th>
                                <th>Tipo</th>
                                <th>Vigencia</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inspecciones as $inspeccion)
                            <tr>
                                <td>{{ $inspeccion['id_inspeccion'] }}</td>
                                <td>{{ $inspeccion['Homoclave'] }}</td>
                                <td>{{ $inspeccion['Nombre_Inspeccion'] }}</td>
                                <td>{{ $inspeccion['Modalidad'] }}</td>
                                <td>{{ $inspeccion['Sujeto_Obligado'] }}</td>
                                <td>{{ $inspeccion['Unidad_Administrativa'] }}</td>
                                <td>{{ $inspeccion['Estatus'] }}</td>
                                <td>{{ $inspeccion['Tipo'] }}</td>
                                <td>{{ $inspeccion['Vigencia'] }}</td>
                                <td class="action-icons">
                                    <a href="{{ base_url('InspeccionesController/form/' . $inspeccion['id_inspeccion']) }}" 
                                       title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ base_url('InspeccionesController/eliminar/' . $inspeccion['id_inspeccion']) }}" 
                                       title="Eliminar" 
                                       onclick="return confirm('¿Estás seguro de eliminar esta inspección?');">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    <style>
        .table thead tr {
            background-color: #8E354A;
            color: white;
        }
        .table td .fas {
            margin: 0 5px;
            color: #8E354A;
            font-size: 1rem;
            transition: transform 0.2s;
        }
        .table td .fas:hover {
            transform: scale(1.2);
            color: #8E354A;
        }
        .table td a {
            text-decoration: none;
        }
        .table th, 
        .table td {
            padding: 0.75rem;
            vertical-align: middle;
            border-top: 1px solid #dee2e6;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: center;
        }
        @media screen and (max-width: 767px) {
            .table th, 
            .table td {
                white-space: normal;
                word-wrap: break-word;
            }
        }
        .btn-warning {
            background-color: #8E354A;
            border-color: #8E354A;
            color: #fff;
        }
        .breadcrumb-item a {
            color: #0d6efd;
        }
    </style>

    <script>
        $(document).ready(function () {
            $('.table').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json",
                    "emptyTable": "No hay datos disponibles en la tabla"
                },
                "ordering": false,
                "paging": false,
                "searching": false,
                "info": false,
                "columnDefs": [
                    { "orderable": false, "targets": '_all' }
                ]
            });
        });
    </script>
@endsection
@section('footer')
    @include('templates/footer')
@endsection